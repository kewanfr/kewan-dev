// // Utilitaire de formatage monétaire
// function money(n) {
//   return new Intl.NumberFormat("fr-FR", {
//     style: "currency",
//     currency: "EUR",
//   }).format(n);
// }

// document.addEventListener("DOMContentLoaded", () => {
//   // ==================== GESTION DU DROPDOWN CUSTOM ====================
//   const dropdownHeader = document.querySelector(
//     "#servicesDropdown .dropdown-header",
//   );
//   const dropdownMenu = document.querySelector(
//     "#servicesDropdown .dropdown-menu",
//   );
//   const servicesCheckboxes = document.querySelectorAll(
//     '#servicesDropdown input[name="services"]',
//   );
//   const servicesPlaceholder = document.getElementById("servicesPlaceholder");
//   const forfaitSelect = document.getElementById("forfait");
//   const dropdownArrow = dropdownHeader?.querySelector("span:last-child");

//   const prixInitialSpan = document.getElementById("prixInitial");
//   const prixMensuelSpan = document.getElementById("prixMensuel");
//   const estimationInitial = document.getElementById("estimationInitial");
//   const estimationMensuel = document.getElementById("estimationMensuel");
//   const estimationVide = document.getElementById("estimationVide");

//   // Style hover options
//   document
//     .querySelectorAll("#servicesDropdown .dropdown-option")
//     .forEach((option) => {
//       option.addEventListener("mouseenter", () => {
//         option.style.background = "rgba(255,255,255,.08)";
//       });
//       option.addEventListener("mouseleave", () => {
//         option.style.background = "transparent";
//       });
//     });

//   // Toggle dropdown
//   if (dropdownHeader && dropdownMenu) {
//     dropdownHeader.addEventListener("click", (e) => {
//       e.stopPropagation();
//       const isOpen = dropdownMenu.style.display === "block";
//       dropdownMenu.style.display = isOpen ? "none" : "block";

//       if (dropdownArrow)
//         dropdownArrow.style.transform = isOpen
//           ? "rotate(0deg)"
//           : "rotate(180deg)";

//       dropdownHeader.style.borderColor = isOpen
//         ? "var(--line)"
//         : "rgba(124,92,255,.35)";
//       dropdownHeader.style.background = isOpen
//         ? "rgba(255,255,255,.04)"
//         : "rgba(124,92,255,.08)";
//     });
//   }

//   // Fermer le dropdown si clic ailleurs
//   document.addEventListener("click", (e) => {
//     if (!e.target.closest("#servicesDropdown")) {
//       if (dropdownMenu) dropdownMenu.style.display = "none";
//       if (dropdownArrow) dropdownArrow.style.transform = "rotate(0deg)";
//       if (dropdownHeader) {
//         dropdownHeader.style.borderColor = "var(--line)";
//         dropdownHeader.style.background = "rgba(255,255,255,.04)";
//       }
//     }
//   });

//   // Placeholder services + estimation
//   function getSelectedServices() {
//     return Array.from(servicesCheckboxes).filter((cb) => cb.checked);
//   }

//   function updateServicesPlaceholder() {
//     if (!servicesPlaceholder) return;
//     const selected = getSelectedServices();

//     if (selected.length === 0) {
//       servicesPlaceholder.textContent = "Sélectionner les prestations...";
//       servicesPlaceholder.style.color = "var(--sub)";
//     } else if (selected.length === 1) {
//       // le label est parent du checkbox (dans ton HTML)
//       const labelText =
//         selected[0].closest("label")?.innerText || selected[0].value;
//       servicesPlaceholder.textContent = labelText.trim().split("(")[0].trim();
//       servicesPlaceholder.style.color = "var(--text)";
//     } else {
//       servicesPlaceholder.textContent = `${selected.length} prestations sélectionnées`;
//       servicesPlaceholder.style.color = "var(--text)";
//     }

//     calculerEstimation();
//   }

//   servicesCheckboxes.forEach((cb) =>
//     cb.addEventListener("change", updateServicesPlaceholder),
//   );
//   forfaitSelect?.addEventListener("change", calculerEstimation);

//   // ==================== CALCUL DE L'ESTIMATION ====================
//   function calculerEstimation() {
//     if (
//       !prixInitialSpan ||
//       !prixMensuelSpan ||
//       !estimationInitial ||
//       !estimationMensuel ||
//       !estimationVide
//     )
//       return;

//     let initialMin = 0;
//     let mensuelMin = 0;
//     let mensuelMax = 0;
//     let hasInitial = false;
//     let hasMensuel = false;
//     let surDevis = false;

//     // Prestations
//     servicesCheckboxes.forEach((checkbox) => {
//       if (!checkbox.checked) return;

//       const minPrice = Number(checkbox.dataset.priceMin || 0);
//       if (minPrice > 0) {
//         initialMin += minPrice;
//         hasInitial = true;
//       } else {
//         // sur devis
//         if (checkbox.value === "backend" || checkbox.value === "conseil") {
//           surDevis = true;
//           hasInitial = true;
//         }
//       }
//     });

//     // Forfait hébergement
//     if (forfaitSelect && forfaitSelect.value) {
//       const selectedOption = forfaitSelect.selectedOptions[0];
//       const minPrice = Number(selectedOption.dataset.priceMin || 0);
//       const maxPrice = Number(selectedOption.dataset.priceMax || 0);
//       if (minPrice > 0) {
//         mensuelMin = minPrice;
//         mensuelMax = maxPrice || minPrice;
//         hasMensuel = true;
//       }
//     }

//     // Affichage
//     if (!hasInitial && !hasMensuel) {
//       estimationVide.style.display = "";
//       estimationInitial.style.display = "none";
//       estimationMensuel.style.display = "none";
//       return;
//     }

//     estimationVide.style.display = "none";

//     if (hasInitial) {
//       estimationInitial.style.display = "";
//       if (surDevis && initialMin === 0) {
//         prixInitialSpan.textContent = "Sur devis";
//       } else if (surDevis) {
//         prixInitialSpan.textContent = `à partir de ${money(initialMin)} + sur devis`;
//       } else {
//         prixInitialSpan.textContent = `à partir de ${money(initialMin)}`;
//       }
//     } else {
//       estimationInitial.style.display = "none";
//     }

//     if (hasMensuel) {
//       estimationMensuel.style.display = "";
//       prixMensuelSpan.textContent =
//         mensuelMin === mensuelMax
//           ? money(mensuelMin)
//           : `${money(mensuelMin)} - ${money(mensuelMax)}`;
//     } else {
//       estimationMensuel.style.display = "none";
//     }
//   }

//   // ==================== VALIDATION + ENVOI (FormData) ====================

//   function clearFormMessages(form) {
//     form
//       .querySelectorAll(".error-message, .form-feedback")
//       .forEach((el) => el.remove());
//   }

//   function addFieldError(form, fieldEl, message) {
//     const wrap = fieldEl?.parentElement || form;
//     const errorDiv = document.createElement("div");
//     errorDiv.className = "error-message";
//     errorDiv.style.color = "#ff6b6b";
//     errorDiv.style.fontSize = "13px";
//     errorDiv.style.marginTop = "4px";
//     errorDiv.textContent = message;
//     wrap.appendChild(errorDiv);
//   }

//   function addFeedback(form, ok, text) {
//     const div = document.createElement("div");
//     div.className = "form-feedback";
//     div.style.padding = "14px";
//     div.style.borderRadius = "12px";
//     div.style.marginTop = "14px";

//     if (ok) {
//       div.style.background = "rgba(56, 189, 248, 0.14)";
//       div.style.border = "1px solid rgba(56, 189, 248, 0.35)";
//       div.style.color = "rgba(56, 189, 248, 0.95)";
//       div.textContent = `✓ ${text}`;
//     } else {
//       div.style.background = "rgba(255, 107, 107, 0.14)";
//       div.style.border = "1px solid rgba(255, 107, 107, 0.35)";
//       div.style.color = "#ff6b6b";
//       div.textContent = `✗ ${text}`;
//     }
//     form.appendChild(div);

//     setTimeout(
//       () => div.scrollIntoView({ behavior: "smooth", block: "nearest" }),
//       80,
//     );
//   }

//   function isValidEmail(email) {
//     return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
//   }

//   async function submitFormWithFetch(form, formType) {
//     clearFormMessages(form);

//     const errors = [];

//     if (formType === "devis") {
//       const nameEl = document.getElementById("name");
//       const emailEl = document.getElementById("email");
//       const messageEl = document.getElementById("message");

//       const name = nameEl?.value.trim() || "";
//       const email = emailEl?.value.trim() || "";
//       const message = messageEl?.value.trim() || "";

//       if (!name) errors.push({ el: nameEl, msg: "Le nom est requis" });
//       if (!email) errors.push({ el: emailEl, msg: "L'email est requis" });
//       else if (!isValidEmail(email))
//         errors.push({ el: emailEl, msg: "L'email n'est pas valide" });

//       // Optionnel: tu voulais forcer au moins une option OU forfait OU autre.
//       // MAIS ton formulaire autorise très bien juste un message (selon ce que tu veux).
//       // Je garde ta logique, mais elle est "soft": seulement si message existe ? Non.
//       const servicesSelected = getSelectedServices().map((cb) => cb.value);
//       const forfait = forfaitSelect?.value || "";
//       const autre = (document.getElementById("autre")?.value || "").trim();

//       if (servicesSelected.length === 0 && !forfait && !autre) {
//         // On accroche l'erreur au dropdown
//         errors.push({
//           el: dropdownHeader,
//           msg: 'Sélectionnez au moins une prestation, un forfait, ou précisez "Autre besoin".',
//         });
//       }

//       if (!message)
//         errors.push({ el: messageEl, msg: "Le message est requis" });
//     } else if (formType === "contact") {
//       const nameEl = document.getElementById("name-contact");
//       const emailEl = document.getElementById("email-contact");
//       const messageEl = document.getElementById("message-contact");

//       const name = nameEl?.value.trim() || "";
//       const email = emailEl?.value.trim() || "";
//       const message = messageEl?.value.trim() || "";

//       if (!name) errors.push({ el: nameEl, msg: "Le nom est requis" });
//       if (!email) errors.push({ el: emailEl, msg: "L'email est requis" });
//       else if (!isValidEmail(email))
//         errors.push({ el: emailEl, msg: "L'email n'est pas valide" });
//       if (!message)
//         errors.push({ el: messageEl, msg: "Le message est requis" });
//     }

//     if (errors.length > 0) {
//       errors.forEach((e) => addFieldError(form, e.el, e.msg));
//       return;
//     }

//     const submitBtn = form.querySelector('button[type="submit"]');
//     const originalBtnText = submitBtn?.textContent || "Envoyer";
//     if (submitBtn) {
//       submitBtn.textContent = "Envoi en cours...";
//       submitBtn.disabled = true;
//     }

//     try {
//       // Envoi "comme un vrai form" (compatible avec ton PHP)
//       const res = await fetch(form.action, {
//         method: "POST",
//         body: new FormData(form),
//         headers: {
//           Accept: "application/json",
//         },
//       });

//       // Ton API renvoie du JSON { ok: true/false }
//       let data = null;
//       try {
//         data = await res.json();
//       } catch (_) {}

//       if (!res.ok || !data || data.ok !== true) {
//         const msg = data?.error || "Erreur lors de l'envoi. Réessayez.";
//         throw new Error(msg);
//       }

//       addFeedback(
//         form,
//         true,
//         "Message envoyé avec succès ! Je vous répondrai rapidement.",
//       );

//       form.reset();

//       if (formType === "devis") {
//         servicesCheckboxes.forEach((cb) => (cb.checked = false));
//         updateServicesPlaceholder();
//         calculerEstimation();
//       }
//     } catch (err) {
//       addFeedback(
//         form,
//         false,
//         err?.message || "Erreur lors de l'envoi. Veuillez réessayer.",
//       );
//     } finally {
//       if (submitBtn) {
//         submitBtn.textContent = originalBtnText;
//         submitBtn.disabled = false;
//       }
//     }
//   }

//   // ==================== ATTACHER LES EVENTS ====================
//   const formDevis = document.querySelector(
//     '#devis form.form[action="/api/devis"]',
//   );
//   if (formDevis) {
//     formDevis.addEventListener("submit", (e) => {
//       e.preventDefault();
//       submitFormWithFetch(formDevis, "devis");
//     });
//   }

//   const formContact = document.querySelector(
//     '#contacter form.form[action="/api/contact"]',
//   );
//   if (formContact) {
//     formContact.addEventListener("submit", (e) => {
//       e.preventDefault();
//       submitFormWithFetch(formContact, "contact");
//     });
//   }

//   // Init affichage placeholder/estimation au chargement
//   updateServicesPlaceholder();
//   calculerEstimation();
// });

// document.addEventListener("DOMContentLoaded", () => {
//   function addFeedback(form, ok, text) {
//     form.querySelectorAll(".form-feedback").forEach((el) => el.remove());
//     const div = document.createElement("div");
//     div.className = "form-feedback";
//     div.style.padding = "14px";
//     div.style.borderRadius = "12px";
//     div.style.marginTop = "14px";
//     div.style.border = ok
//       ? "1px solid rgba(56, 189, 248, 0.35)"
//       : "1px solid rgba(255, 107, 107, 0.35)";
//     div.style.background = ok
//       ? "rgba(56, 189, 248, 0.14)"
//       : "rgba(255, 107, 107, 0.14)";
//     div.style.color = ok ? "rgba(56, 189, 248, 0.95)" : "#ff6b6b";
//     div.textContent = (ok ? "✓ " : "✗ ") + text;
//     form.appendChild(div);
//     setTimeout(
//       () => div.scrollIntoView({ behavior: "smooth", block: "nearest" }),
//       80,
//     );
//   }

//   function isValidEmail(email) {
//     return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
//   }

//   async function submitViaFetch(form, formType) {
//     // Validation minimale adaptée à TES champs
//     if (formType === "contact") {
//       const name = (form.querySelector("#name-contact")?.value || "").trim();
//       const email = (form.querySelector("#email-contact")?.value || "").trim();
//       const message = (
//         form.querySelector("#message-contact")?.value || ""
//       ).trim();

//       if (!name) return addFeedback(form, false, "Le nom est requis.");
//       if (!email) return addFeedback(form, false, "L'email est requis.");
//       if (!isValidEmail(email))
//         return addFeedback(form, false, "L'email n'est pas valide.");
//       if (!message) return addFeedback(form, false, "Le message est requis.");
//     }

//     if (formType === "devis") {
//       const name = (form.querySelector("#name")?.value || "").trim();
//       const email = (form.querySelector("#email")?.value || "").trim();
//       const message = (form.querySelector("#message")?.value || "").trim();

//       if (!name) return addFeedback(form, false, "Le nom est requis.");
//       if (!email) return addFeedback(form, false, "L'email est requis.");
//       if (!isValidEmail(email))
//         return addFeedback(form, false, "L'email n'est pas valide.");
//       if (!message) return addFeedback(form, false, "Le message est requis.");
//     }

//     const submitBtn = form.querySelector('button[type="submit"]');
//     const original = submitBtn?.textContent || "Envoyer";
//     if (submitBtn) {
//       submitBtn.disabled = true;
//       submitBtn.textContent = "Envoi en cours...";
//     }

//     try {
//       const res = await fetch(form.action, {
//         method: "POST",
//         body: new FormData(form),
//         headers: { Accept: "application/json" },
//         credentials: "same-origin",
//       });

//       let data = null;
//       try {
//         data = await res.json();
//       } catch (_) {}

//       if (!res.ok || !data || data.ok !== true) {
//         throw new Error(
//           data?.error || `Erreur (${res.status}) lors de l'envoi.`,
//         );
//       }

//       addFeedback(form, true, "Message envoyé avec succès !");
//       form.reset();

//       // Si devis : reset services + estimation si tu as ces éléments
//       if (formType === "devis") {
//         document
//           .querySelectorAll('#servicesDropdown input[name="services"]')
//           .forEach((cb) => (cb.checked = false));
//         // Si tu as tes fonctions updateServicesPlaceholder/calculerEstimation, appelle-les ici si elles existent
//         if (typeof window.updateServicesPlaceholder === "function")
//           window.updateServicesPlaceholder();
//         if (typeof window.calculerEstimation === "function")
//           window.calculerEstimation();
//       }
//     } catch (err) {
//       addFeedback(form, false, err?.message || "Erreur lors de l'envoi.");
//     } finally {
//       if (submitBtn) {
//         submitBtn.disabled = false;
//         submitBtn.textContent = original;
//       }
//     }
//   }

//   // 🔒 Sélecteurs robustes: on prend les forms par action
//   const formContact = document.querySelector('form[action="/api/contact"]');
//   const formDevis = document.querySelector('form[action="/api/devis"]');

//   if (formContact) {
//     formContact.addEventListener("submit", (e) => {
//       e.preventDefault();
//       e.stopPropagation();
//       submitViaFetch(formContact, "contact");
//     });
//   }

//   if (formDevis) {
//     formDevis.addEventListener("submit", (e) => {
//       e.preventDefault();
//       e.stopPropagation();
//       submitViaFetch(formDevis, "devis");
//     });
//   }

//   // Petit check debug (tu peux supprimer après)
//   console.log("[forms] contact=", !!formContact, "devis=", !!formDevis);
// };);


document.addEventListener("DOMContentLoaded", () => {
  function addFeedback(form, ok, text) {
    form.querySelectorAll(".form-feedback").forEach((el) => el.remove());
    const div = document.createElement("div");
    div.className = "form-feedback";
    div.style.padding = "14px";
    div.style.borderRadius = "12px";
    div.style.marginTop = "14px";
    div.style.border = ok
      ? "1px solid rgba(56, 189, 248, 0.35)"
      : "1px solid rgba(255, 107, 107, 0.35)";
    div.style.background = ok
      ? "rgba(56, 189, 248, 0.14)"
      : "rgba(255, 107, 107, 0.14)";
    div.style.color = ok ? "rgba(56, 189, 248, 0.95)" : "#ff6b6b";
    div.textContent = (ok ? "✓ " : "✗ ") + text;
    form.appendChild(div);
    setTimeout(
      () => div.scrollIntoView({ behavior: "smooth", block: "nearest" }),
      80,
    );
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  async function submitViaFetch(form, formType) {
    // Validation minimale adaptée à TES champs
    if (formType === "contact") {
      const name = (form.querySelector("#name-contact")?.value || "").trim();
      const email = (form.querySelector("#email-contact")?.value || "").trim();
      const message = (
        form.querySelector("#message-contact")?.value || ""
      ).trim();

      if (!name) return addFeedback(form, false, "Le nom est requis.");
      if (!email) return addFeedback(form, false, "L'email est requis.");
      if (!isValidEmail(email))
        return addFeedback(form, false, "L'email n'est pas valide.");
      if (!message) return addFeedback(form, false, "Le message est requis.");
    }

    if (formType === "devis") {
      const name = (form.querySelector("#name")?.value || "").trim();
      const email = (form.querySelector("#email")?.value || "").trim();
      const message = (form.querySelector("#message")?.value || "").trim();

      if (!name) return addFeedback(form, false, "Le nom est requis.");
      if (!email) return addFeedback(form, false, "L'email est requis.");
      if (!isValidEmail(email))
        return addFeedback(form, false, "L'email n'est pas valide.");
      if (!message) return addFeedback(form, false, "Le message est requis.");
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    const original = submitBtn?.textContent || "Envoyer";
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = "Envoi en cours...";
    }

    try {

      const res = await fetch(`https://kewan.dev/api/devis` {
        method: "POST",
        body: new FormData(form),
        headers: { Accept: "application/json" },
        credentials: "same-origin",
      });


      let data = null;
      try {
        data = await res.json();
      } catch (_) {}

      if (!res.ok || !data || data.ok !== true) {
        throw new Error(
          data?.error || `Erreur (${res.status}) lors de l'envoi.`,
        );
      }

      addFeedback(form, true, "Message envoyé avec succès !");
      form.reset();

      // Si devis : reset services + estimation si tu as ces éléments
      if (formType === "devis") {
        document
          .querySelectorAll('#servicesDropdown input[name="services"]')
          .forEach((cb) => (cb.checked = false));
        // Si tu as tes fonctions updateServicesPlaceholder/calculerEstimation, appelle-les ici si elles existent
        if (typeof window.updateServicesPlaceholder === "function")
          window.updateServicesPlaceholder();
        if (typeof window.calculerEstimation === "function")
          window.calculerEstimation();
      }
    } catch (err) {
      addFeedback(form, false, err?.message || "Erreur lors de l'envoi.");
    } finally {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = original;
      }
    }
  }

  // 🔒 Sélecteurs robustes: on prend les forms par action
  const formContact = document.querySelector('form[action="/api/contact"]');
  const formDevis = document.querySelector('form[action="/api/devis"]');

  if (formContact) {
    formContact.addEventListener("submit", (e) => {
      e.preventDefault();
      e.stopPropagation();
      submitViaFetch(formContact, "contact");
    });
  }

  if (formDevis) {
    formDevis.addEventListener("submit", (e) => {
      e.preventDefault();
      e.stopPropagation();
      submitViaFetch(formDevis, "devis");
    });
  }

  // Petit check debug (tu peux supprimer après)
  console.log("[forms] contact=", !!formContact, "devis=", !!formDevis);
});
