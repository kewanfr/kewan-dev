// Utilitaire de formatage monétaire
function money(n) {
  return new Intl.NumberFormat("fr-FR", { style: "currency", currency: "EUR" }).format(n);
}

document.addEventListener("DOMContentLoaded", () => {
  // ==================== GESTION DU DROPDOWN CUSTOM ====================
  const dropdownHeader = document.querySelector('.dropdown-header');
  const dropdownMenu = document.querySelector('.dropdown-menu');
  const servicesCheckboxes = document.querySelectorAll('input[name="services"]');
  const servicesPlaceholder = document.getElementById('servicesPlaceholder');
  const forfaitSelect = document.getElementById('forfait');
  const dropdownArrow = dropdownHeader?.querySelector('span:last-child');
  
  const prixInitialSpan = document.getElementById("prixInitial");
  const prixMensuelSpan = document.getElementById("prixMensuel");
  const estimationInitial = document.getElementById("estimationInitial");
  const estimationMensuel = document.getElementById("estimationMensuel");
  const estimationVide = document.getElementById("estimationVide");

  // Ajouter le style hover aux options
  const dropdownOptions = document.querySelectorAll('.dropdown-option');
  dropdownOptions.forEach(option => {
    option.addEventListener('mouseenter', () => {
      option.style.background = 'rgba(255,255,255,.08)';
    });
    option.addEventListener('mouseleave', () => {
      option.style.background = 'transparent';
    });
  });

  // Toggle dropdown avec animation
  if (dropdownHeader) {
    dropdownHeader.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = dropdownMenu.style.display === 'block';
      dropdownMenu.style.display = isOpen ? 'none' : 'block';
      if (dropdownArrow) {
        dropdownArrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
      }
      if (!isOpen) {
        dropdownHeader.style.borderColor = 'rgba(124,92,255,.35)';
        dropdownHeader.style.background = 'rgba(124,92,255,.08)';
      } else {
        dropdownHeader.style.borderColor = 'var(--line)';
        dropdownHeader.style.background = 'rgba(255,255,255,.04)';
      }
    });
  }

  // Fermer le dropdown si on clique ailleurs
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.custom-dropdown')) {
      if (dropdownMenu) dropdownMenu.style.display = 'none';
      if (dropdownArrow) dropdownArrow.style.transform = 'rotate(0deg)';
      if (dropdownHeader) {
        dropdownHeader.style.borderColor = 'var(--line)';
        dropdownHeader.style.background = 'rgba(255,255,255,.04)';
      }
    }
  });

  // Mise à jour du placeholder
  function updateServicesPlaceholder() {
    const selected = Array.from(servicesCheckboxes).filter(cb => cb.checked);
    if (selected.length === 0) {
      servicesPlaceholder.textContent = 'Sélectionner les prestations...';
      servicesPlaceholder.style.color = 'var(--sub)';
    } else if (selected.length === 1) {
      servicesPlaceholder.textContent = selected[0].parentElement.textContent.trim().split('(')[0].trim();
      servicesPlaceholder.style.color = 'var(--text)';
    } else {
      servicesPlaceholder.textContent = `${selected.length} prestations sélectionnées`;
      servicesPlaceholder.style.color = 'var(--text)';
    }
    calculerEstimation();
  }

  servicesCheckboxes.forEach(cb => {
    cb.addEventListener('change', updateServicesPlaceholder);
  });

  if (forfaitSelect) {
    forfaitSelect.addEventListener('change', calculerEstimation);
  }

  // ==================== CALCUL DE L'ESTIMATION ====================
  function calculerEstimation() {
    let initialMin = 0;
    let mensuelMin = 0;
    let mensuelMax = 0;
    let hasInitial = false;
    let hasMensuel = false;
    let surDevis = false;

    // Calcul des prestations
    servicesCheckboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        const minPrice = Number(checkbox.dataset.priceMin || 0);
        if (minPrice > 0) {
          initialMin += minPrice;
          hasInitial = true;
        } else if (checkbox.value === 'backend' || checkbox.value === 'conseil') {
          surDevis = true;
          hasInitial = true;
        }
      }
    });

    // Calcul du forfait d'hébergement
    if (forfaitSelect && forfaitSelect.value) {
      const selectedOption = forfaitSelect.selectedOptions[0];
      const minPrice = Number(selectedOption.dataset.priceMin || 0);
      const maxPrice = Number(selectedOption.dataset.priceMax || 0);
      if (minPrice > 0) {
        mensuelMin = minPrice;
        mensuelMax = maxPrice;
        hasMensuel = true;
      }
    }

    // Affichage
    if (!hasInitial && !hasMensuel) {
      estimationVide.style.display = '';
      estimationInitial.style.display = 'none';
      estimationMensuel.style.display = 'none';
    } else {
      estimationVide.style.display = 'none';
      
      if (hasInitial) {
        estimationInitial.style.display = '';
        if (surDevis && initialMin === 0) {
          prixInitialSpan.textContent = "Sur devis";
        } else if (surDevis) {
          prixInitialSpan.textContent = `à partir de ${money(initialMin)} + sur devis`;
        } else {
          prixInitialSpan.textContent = `à partir de ${money(initialMin)}`;
        }
      } else {
        estimationInitial.style.display = 'none';
      }

      if (hasMensuel) {
        estimationMensuel.style.display = '';
        if (mensuelMin === mensuelMax) {
          prixMensuelSpan.textContent = money(mensuelMin);
        } else {
          prixMensuelSpan.textContent = `${money(mensuelMin)} - ${money(mensuelMax)}`;
        }
      } else {
        estimationMensuel.style.display = 'none';
      }
    }
  }

  // ==================== VALIDATION FORMULAIRES ====================
  
  // Fonction pour valider et envoyer un formulaire
  async function handleFormSubmit(form, formType) {
    const errors = [];
    let formData = {};

    if (formType === 'devis') {
      // Récupération des données du formulaire devis
      formData = {
        type: 'devis',
        name: document.getElementById('name').value.trim(),
        email: document.getElementById('email').value.trim(),
        phone: document.getElementById('phone').value.trim(),
        personType: document.getElementById('personType').value,
        services: Array.from(servicesCheckboxes).filter(cb => cb.checked).map(cb => cb.value),
        forfait: forfaitSelect.value,
        autre: document.getElementById('autre').value.trim(),
        message: document.getElementById('message').value.trim()
      };

      // Validation
      if (!formData.name) {
        errors.push({ field: 'name', message: 'Le nom est requis' });
      }
      
      if (!formData.email) {
        errors.push({ field: 'email', message: 'L\'email est requis' });
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
        errors.push({ field: 'email', message: 'L\'email n\'est pas valide' });
      }
      
      if (formData.services.length === 0 && !formData.forfait && !formData.autre) {
        errors.push({ field: 'services', message: 'Veuillez sélectionner au moins une prestation ou forfait' });
      }

      if (!formData.message) {
        errors.push({ field: 'message', message: 'Le message est requis' });
      }
    } else if (formType === 'contact') {
      // Récupération des données du formulaire contact
      formData = {
        type: 'contact',
        name: document.getElementById('name-contact').value.trim(),
        email: document.getElementById('email-contact').value.trim(),
        phone: document.getElementById('phone-contact').value.trim(),
        message: document.getElementById('message-contact').value.trim()
      };

      // Validation
      if (!formData.name) {
        errors.push({ field: 'name-contact', message: 'Le nom est requis' });
      }
      
      if (!formData.email) {
        errors.push({ field: 'email-contact', message: 'L\'email est requis' });
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
        errors.push({ field: 'email-contact', message: 'L\'email n\'est pas valide' });
      }

      if (!formData.message) {
        errors.push({ field: 'message-contact', message: 'Le message est requis' });
      }
    }

    // Affichage des erreurs
    form.querySelectorAll('.error-message').forEach(el => el.remove());
    
    if (errors.length > 0) {
      errors.forEach(error => {
        const field = document.getElementById(error.field) || dropdownHeader;
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = '#ff6b6b';
        errorDiv.style.fontSize = '13px';
        errorDiv.style.marginTop = '4px';
        errorDiv.textContent = error.message;
        field.parentElement.appendChild(errorDiv);
      });
      return;
    }

    // Envoi vers l'API
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.textContent;
    submitBtn.textContent = 'Envoi en cours...';
    submitBtn.disabled = true;

    try {
      const response = await fetch('/api/contact', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });

      if (response.ok) {
        // Succès
        const successDiv = document.createElement('div');
        successDiv.style.padding = '14px';
        successDiv.style.background = 'rgba(56, 189, 248, 0.14)';
        successDiv.style.border = '1px solid rgba(56, 189, 248, 0.35)';
        successDiv.style.borderRadius = '12px';
        successDiv.style.marginTop = '14px';
        successDiv.style.color = 'rgba(56, 189, 248, 0.95)';
        successDiv.textContent = '✓ Message envoyé avec succès ! Nous vous répondrons rapidement.';
        form.appendChild(successDiv);
        
        // Réinitialiser le formulaire
        form.reset();
        if (formType === 'devis') {
          servicesCheckboxes.forEach(cb => cb.checked = false);
          updateServicesPlaceholder();
          calculerEstimation();
        }

        // Auto-scroll vers le message de succès
        setTimeout(() => {
          successDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 100);
      } else {
        throw new Error('Erreur lors de l\'envoi');
      }
    } catch (error) {
      // Échec
      const errorDiv = document.createElement('div');
      errorDiv.style.padding = '14px';
      errorDiv.style.background = 'rgba(255, 107, 107, 0.14)';
      errorDiv.style.border = '1px solid rgba(255, 107, 107, 0.35)';
      errorDiv.style.borderRadius = '12px';
      errorDiv.style.marginTop = '14px';
      errorDiv.style.color = '#ff6b6b';
      errorDiv.textContent = '✗ Erreur lors de l\'envoi. Veuillez réessayer ou me contacter directement par mail.';
      form.appendChild(errorDiv);
    } finally {
      submitBtn.textContent = originalBtnText;
      submitBtn.disabled = false;
    }
  }

  // ==================== ATTACHER LES ÉVÉNEMENTS AUX FORMULAIRES ====================
  
  // Formulaire de devis
  const formDevis = document.querySelector('#devis .form');
  if (formDevis) {
    formDevis.addEventListener('submit', async (e) => {
      e.preventDefault();
      await handleFormSubmit(formDevis, 'devis');
    });
  }

  // Formulaire de contact
  const formContact = document.querySelector('#contacter .form');
  if (formContact) {
    formContact.addEventListener('submit', async (e) => {
      e.preventDefault();
      await handleFormSubmit(formContact, 'contact');
    });
  }
});
