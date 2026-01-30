<?php

var_dump(getenv('ADMIN_PASSWORD_HASH', ''));
var_dump(getenv('SMTP_HOST', ''));
var_dump(getenv('DB_USER', ''));


echo "test";

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kewan Dev · Freelance</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />

  <meta name="description" content="Kewan BERNIER, développeur web et applications en freelance. Étudiant en informatique à Nantes, je propose des services techniques accessibles aux particuliers et petites structures." />
  <meta name="keywords" content="Kewan Dev, Kewan BERNIER, freelance, développeur, développeur web, développeur d'applications, informatique, Nantes, services informatiques, hébergement, maintenance, conseil, cours informatique" />
  <meta name="author" content="Kewan BERNIER" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:title" content="Kewan Dev · Freelance développeur" />
  <meta property="og:description" content="Kewan BERNIER, développeur web et applications en freelance. Étudiant en informatique à Nantes, je propose des services techniques accessibles aux particuliers et petites structures." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://kewan.dev/" />
  <meta property="og:image" content="https://kewan.dev/assets/photo.jpg" />
</head>
<body>
  <a class="skip" href="#content">Aller au contenu</a>

  <header class="header">
    <div class="container header-inner">
      <div class="brand">
        <span class="logo" aria-hidden="true"></span>
        <span>Kewan Dev</span>
      </div>

      <nav class="nav" aria-label="Navigation principale">
        <a href="#a-propos" data-section>À propos</a>
        <a href="#services" data-section>Services</a>
        <a href="#tarifs" data-section>Tarifs</a>
        <a href="#devis" data-section>Devis</a>
        <a href="#contacter" data-section>Contact</a>
        <a class="lang" href="/en/" aria-label="Switch to English">🇬🇧 EN</a>
      </nav>
    </div>
  </header>

    <section style="margin: 2em 0; display: flex; align-items: center; gap: 2em; justify-content: center;" tabindex="-1">
      <img src="/assets/img/photo.jpg" alt="Photo de Kewan BERNIER" style="width: 160px; height: 160px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc;">
      <div>
        <h2>À propos de moi</h2>
        <p>Kewan BERNIER, développeur alternant et étudiant en BUT Informatique à Nantes.<br>
          Je propose mes services en freelance pour acquérir de l'expérience. <br>
      </div>
    </section>

  <main id="content">
    <section class="hero" id="a-propos" tabindex="-1" >
      <div class="container hero-grid">
        <div class="panel reveal">
          <div class="kicker">Étudiant & alternant · freelance</div>
          <h1>Du conseil jusqu'au déploiement.</h1>
          <p class="sub">
            Un besoin technique ou un questionnement pour votre site web ou application ?<br />
            Une volonté nouvelle, d'évolution ou de maintenance ?<br /><br /><br />

            Solutions simples et fiables, prix accessibles pour les petites structures et indépendants. <br />
            Mais aussi aux particuliers pour des cours ou de l'aide informatique.
            <br /><br />
          </p>

          <div class="hero-actions">
            <a class="btn btn-primary" href="#devis">Demander un devis</a>
            <a class="btn" href="#services">Voir les services</a>
          </div>

          <div class="mini">
            <!-- <div class="mini-row">
              <span class="pill">Acompte au démarrage</span>
              <span class="pill">Solde à la validation</span>
              <span class="pill">Ajustements raisonnables</span>
            </div> -->
            <p class="small">
              Je suis moins orienté design et graphisme. Si besoin, je peux recommander ou passer par un designer, et je m’occupe du technique.
            </p>
          </div>
        </div>

        <div class="hero-visual reveal" aria-label="Aperçu technique">
          <div class="visual-inner">
            <div class="mock">
              <div class="mock-top">
                <div class="dots" aria-hidden="true">
                  <span class="dot"></span><span class="dot"></span><span class="dot"></span>
                </div>
                <span class="small">Deploy · SSL · Monitoring</span>
              </div>
              <pre class="code">> audit site
✔ performance: 87/100
✔ ssl: ok
✔ backups: daily
✔ uptime: 99.9%

> deploy
✔ build
✔ upload
✔ cache purge</pre>
            </div>

            <div class="mock">
              <pre class="code">Forfaits hébergement
Essentiel: 8–12 €/mois
Standard: 15–20 €/mois
Avancé: 25–35 €/mois</pre>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="services" class="section" tabindex="-1">
      <div class="container">
        <div class="section-head">
          <h2>Services</h2>
          <div class="hint">A titre indicatif, me contacter pour tout autre besoin</div>
        </div>

        <div class="grid1" style="align-items: center;">
          <div class="card reveal" style="grid-column: 2;">
            <h3>Cours & aide informatique</h3>
            <p>Accompagnement pour particuliers: débutant ou avancé.</p>
            <ul class="bullets">
              <li>Utilisation d'un ordinateur (Windows, MacOS, Linux)</li>
              <li>Utilisation d'un téléphone ou tablette (iOS, Android)</li>
              <li>Utilisation d'internet et des outils bureautique</li>
              <li>Concepts plus avancés</li>
            </ul>
          </div>
        </div>


        <div class="grid3" style="margin-top:4vh" > 
          <div class="card reveal">
            <div class="icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 6h16v12H4V6zm2 2v8h12V8H6z"/></svg>
            </div>
            <h3>Hébergement & maintenance</h3>
            <p>Un service mensuel simple, stable, sans surprise.</p>
            <ul class="bullets">
              <li>Mises à jour et sauvegardes</li>
              <li>Surveillance</li>
              <li>Support humain</li>
            </ul>
          </div>

          <div class="card reveal">
            <div class="icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 2l9 4v6c0 5-4 9-9 10C7 21 3 17 3 12V6l9-4z"/></svg>
            </div>
            <h3>Conseil & accompagnement</h3>
            <p>Je vous aide à choisir et mettre en place la bonne solution.</p>
            <ul class="bullets">
              <li>Déploiement, domaine, solutions</li>
              <li>Migrations (site, données)</li>
              <li>Audit rapide et priorités</li>
            </ul>
          </div>

          <div class="card reveal">
            <div class="icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M7 7h10v10H7V7zm-4 4h2v2H3v-2zm16 0h2v2h-2v-2zM11 3h2v2h-2V3zm0 16h2v2h-2v-2z"/></svg>
            </div>
            <h3>Backend & automatisations</h3>
            <p>API, base de données, scripts, intégrations.</p>
            <ul class="bullets">
              <li>APIs ou Webhooks</li>
              <li>Automatisations, jobs, scripts</li>
              <li>Bots et automatisations / IoT</li>
            </ul>
          </div>
        </div>

        <div class="grid1" style="margin-top:26px">
          <div class="card reveal">
            <h3>Sites web simples</h3>
            <p>WordPress ou vitrine statique simple.</p>
            <ul class="bullets">
              <li>Création de vitrine simple</li>
              <li>Corrections et mises à jour</li>
              <li>Optimisation vitesse</li>
            </ul>
          </div>

          <!-- <div class="card reveal">
            <h3>Ce que tu obtiens</h3>
            <p>Un périmètre clair, une estimation avant action, et du suivi.</p>
            <ul class="bullets">
              <li>Devis clair</li>
              <li>Livraison + validation</li>
              <li>Option mensuelle si besoin</li>
            </ul>
          </div> -->
        </div>
      </div>
    </section>


    <section id="tarifs" class="section" tabindex="-1">
      <div class="container">
        <div class="section-head">
          <h2>Tarifs</h2>
          <div class="hint">Prix faibles, en raison de mon statut d’étudiant, mais toujours négociables</div>
        </div>

        <div class="grid2">
          <div class="card reveal">
            <div class="price">25 € / heure</div>
            <p>Cours, interventions, maintenance, conseil, petites évolutions.</p>
            <p class="small">(Peut évoluer selon le projet, les besoins et le budget)</p>
          </div>

          <div class="card reveal">
            <div class="price">Forfaits</div>
            <p>Pour des besoins simples. Au-delà, facturation à l’heure.</p>
            <table class="table" aria-label="Forfaits">
              <thead>
                <tr><th>Prestation</th><th>Prix</th><th>Détails</th></tr>
              </thead>
              <tbody>

                <tr>
                  <td>Cours & aide informatique</td>
                  <td><strong>à partir de 60€ - 3h</strong></td>
                  <td>Selon le besoin, débutant ou avancé</td>
                </tr>
                <tr>
                  <td>Site vitrine</td>
                  <td><strong>à partir de 350 €</strong></td>
                  <td>Pages essentielles, responsive, mise en ligne</td>
                </tr>
                <tr>
                  <td>WordPress (thème existant)</td>
                  <td><strong>à partir de 400 €</strong></td>
                  <td>Installation, config, sécurité de base</td>
                </tr>
                <tr>
                  <td>Backend / scripts</td>
                  <td><strong>sur devis</strong></td>
                  <td>API, automatisations, bases de données</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="grid3" style="margin-top:26px">
          <div class="card reveal">
            <div class="price">8 à 12 € / mois</div>
            <p>Hébergement Essentiel</p>
            <ul class="bullets">
              <li>1 site, faible trafic</li>
              <li>Mises à jour basiques</li>
              <li>Support régulier</li>
            </ul>
            <p class="small">Hébergement mutualisé.</p>
          </div>

          <div class="card reveal">
            <div class="price">15 à 20 € / mois</div>
            <p>Hébergement Standard</p>
            <ul class="bullets">
              <li>1 à 3 sites ou fort trafic</li>
              <li>Sauvegardes</li>
              <li>Support régulier</li>
            </ul>
            <p class="small">Hébergement mutualisé ou dédié</p>
          </div>

          <div class="card reveal">
            <div class="price">25 à 35 € / mois</div>
            <p>Hébergement Avancé</p>
            <ul class="bullets">
              <li>Plusieurs sites ou trafic élevé</li>
              <li>Surveillance</li>
              <li>Accompagnement technique</li>
            </ul>
            <p class="small">Hébergement dédié</p>
          </div>
        </div>

        <div class="card reveal" style="margin-top:26px">
          <h3>Paiement</h3>
          <p class="sub">Je demande un acompte de 30%, solde après présentation et validation. Des ajustements raisonnables sont possibles.</p>
        </div>
      </div>
    </section>

    <section id="devis" class="section" tabindex="-1">
      <div class="container">
        <div class="section-head">
          <h2>Devis</h2>
          <div class="hint">Choisissez vos besoins, estimation immédiate</div>
        </div>

        <div class="card reveal">
          <form class="form" action="/api/devis" method="post">
            <div class="form-grid">
              <div>
                <label for="name">Nom <span style="color: red;">*</span></label>
                <input id="name" name="name" autocomplete="name" required />
              </div>
              <div>
                <label for="personType">Particulier ? Professionnel ?</label>
                <select id="personType" name="personType">
                  <option value="">-- Sélectionner --</option>
                  <option value="particulier">Particulier</option>
                  <option value="entreprise">Professionnel</option>
                  <option value="association">Association</option>
                  <option value="autre">Autre</option>
                </select>
              </div>
            </div>

            <div class="form-grid">
              <div>
                <label for="email">Adresse mail <span style="color: red;">*</span></label>
                <input id="email" name="email" type="email" autocomplete="email" required />
              </div>
              <div>
                <label for="phone">Numéro de Téléphone <span class="small">(optionnel)</span></label>
                <input id="phone" name="phone" type="tel" autocomplete="tel" />
              </div>
            </div>

            <hr style="margin: 24px 0;" />
            <span class="small">Optionnel: </span>
            <div>
              <label for="servicesDropdown">Type(s) de prestation souhaité(s)</label>
              <div class="custom-dropdown" id="servicesDropdown" style="position: relative;">
                <div class="dropdown-header" style="padding: 12px 16px; border: 1px solid var(--line); border-radius: 14px; background: rgba(255,255,255,.04); cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all .16s ease; font: inherit; color: var(--text);">
                  <span id="servicesPlaceholder" style="color: var(--sub);">Sélectionner les prestations...</span>
                  <span style="margin-left: 10px; transition: transform .2s ease;">▼</span>
                </div>
                <div class="dropdown-menu" style="display: none; position: absolute; z-index: 100; background: var(--bg2); border: 1px solid var(--line); border-radius: 14px; margin-top: 6px; max-height: 320px; overflow-y: auto; box-shadow: 0 12px 40px rgba(0,0,0,.5); width: 100%; backdrop-filter: blur(10px); animation: slideDown .2s ease;">
                  <label class="dropdown-option" style="display: flex; align-items: center; padding: 12px 16px; cursor: pointer; transition: background .12s ease; user-select: none;">
                    <input type="checkbox" name="services" value="cours" data-price-min="60" style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: var(--accent);">
                    <span>Cours & aide informatique <span style="color: var(--sub); font-size: 13px;">(à partir de 60€)</span></span>
                  </label>
                  <label class="dropdown-option" style="display: flex; align-items: center; padding: 12px 16px; cursor: pointer; transition: background .12s ease; user-select: none;">
                    <input type="checkbox" name="services" value="vitrine" data-price-min="350" style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: var(--accent);">
                    <span>Site vitrine <span style="color: var(--sub); font-size: 13px;">(à partir de 350€)</span></span>
                  </label>
                  <label class="dropdown-option" style="display: flex; align-items: center; padding: 12px 16px; cursor: pointer; transition: background .12s ease; user-select: none;">
                    <input type="checkbox" name="services" value="wordpress" data-price-min="400" style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: var(--accent);">
                    <span>WordPress <span style="color: var(--sub); font-size: 13px;">(à partir de 400€)</span></span>
                  </label>
                  <label class="dropdown-option" style="display: flex; align-items: center; padding: 12px 16px; cursor: pointer; transition: background .12s ease; user-select: none;">
                    <input type="checkbox" name="services" value="backend" style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: var(--accent);">
                    <span>Backend / scripts <span style="color: var(--sub); font-size: 13px;">(sur devis)</span></span>
                  </label>
                  <label class="dropdown-option" style="display: flex; align-items: center; padding: 12px 16px; cursor: pointer; transition: background .12s ease; user-select: none;">
                    <input type="checkbox" name="services" value="conseil" style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: var(--accent);">
                    <span>Conseil & accompagnement</span>
                  </label>
                  <label class="dropdown-option" style="display: flex; align-items: center; padding: 12px 16px; cursor: pointer; transition: background .12s ease; user-select: none;">
                    <input type="checkbox" name="services" value="intervention" data-price-hourly="25" style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: var(--accent);">
                    <span>Intervention / maintenance <span style="color: var(--sub); font-size: 13px;">(25€/h)</span></span>
                  </label>
                </div>
              </div>
            </div>

            <div>
              <label for="forfait">Forfait d'hébergement mensuel</label>
              <select id="forfait" name="forfait">
                <option value="">-- Aucun --</option>
                <option value="essentiel" data-price-min="8" data-price-max="12">Essentiel (8-12€/mois)</option>
                <option value="standard" data-price-min="15" data-price-max="20">Standard (15-20€/mois)</option>
                <option value="avance" data-price-min="25" data-price-max="35">Avancé (25-35€/mois)</option>
              </select>
            </div>

            <div>
              <label for="autre">Autre besoin</label>
              <input id="autre" name="autre" placeholder="Précisez un besoin personnalisé" />
            </div>

            <div style="margin: 18px 0; padding: 14px; background: rgba(124,92,255,.08); border-radius: 12px; border: 1px solid rgba(124,92,255,.2);">
              <div><strong>Estimation indicative :</strong></div>
              <div style="margin-top: 8px;">
                <span id="estimationInitial" style="display: none;">Initial : <strong><span id="prixInitial">—</span></strong><br></span>
                <span id="estimationMensuel" style="display: none;">Mensuel : <strong><span id="prixMensuel">—</span></strong></span>
                <span id="estimationVide" style="color: var(--sub);">Sélectionnez des options pour voir une estimation</span>
              </div>
            </div>

            <br>

            <br>

            <div>
              <label for="message">Message <span style="color: red;">*</span></label>
              <textarea id="message" name="message" placeholder="Décrivez le besoin, le délai, etc." required rows="7"></textarea>
            </div>

            <div style="display:flex; gap:12px; flex-wrap:wrap;">
              <button class="btn btn-primary" type="submit">Envoyer</button>
              <a class="btn" href="#pricing">Voir les tarifs</a>
            </div>

            <!-- <p class="small">Acompte au démarrage. Solde à la validation. Ajustements raisonnables inclus.</p> -->
          </form>
        </div>
      </div>
    </section>


    <section id="contacter" class="section" tabindex="-1" style="margin-bottom: 10vh;">
      <div class="container">
        <div class="section-head">
          <h2>Contact</h2>
          <div class="hint">Me contacter pour toute question ou autre besoin </div>
        </div>

        <div class="card reveal">
          <form class="form" action="/api/contact" method="post">
            <div class="form-grid">
              <div>
                <label for="name-contact">Nom <span style="color: red;">*</span></label>
                <input id="name-contact" name="name-contact" autocomplete="name" required />
              </div>
            </div>

            <div class="form-grid">
              <div>
                <label for="email-contact">Adresse mail <span style="color: red;">*</span></label>
                <input id="email-contact" name="email-contact" type="email" autocomplete="email" required />
              </div>
              <div>
                <label for="phone-contact">Numéro de Téléphone <span class="small">(optionnel)</span></label>
                <input id="phone-contact" name="phone-contact" type="tel" autocomplete="tel" />
              </div>
            </div>

            <div>
              <label for="message-contact">Message <span style="color: red;">*</span></label>
              <textarea id="message-contact" name="message-contact" placeholder="Votre message" required rows="7"></textarea>
            </div>

            <div style="display:flex; gap:12px; flex-wrap:wrap;">
              <button class="btn btn-primary" type="submit">Envoyer</button>
            </div>

            <!-- <p class="small">Acompte au démarrage. Solde à la validation. Ajustements raisonnables inclus.</p> -->
          </form>
        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="container footer-row">
        <div>
          <div>© <span id="year"></span> Kewan Dev</div>
          <div class="small" style="margin-top: 8px; opacity: 0.7;">Établissement actif depuis le 14/07/2025</div>
          <div class="small" style="opacity: 0.7;">SIRET : 989 200 910 00010</div>
        </div>
        <div>
          <a href="/mentions-legales" class="small">Mentions légales</a>
          <span class="small" style="margin: 0 10px;">·</span>
          <a href="/contacter" class="small">Contact</a>
        </div>
      </div>
    </footer>
  </main>

  <script src="/assets/js/forms.js"></script>
  <script src="/assets/js/main.js"></script>
</body>
</html>
