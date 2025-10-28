# Insuffle Framework

**Version:** 1.0.0
**Auteur:** Insuffle
**Licence:** GPL v2 or later

Un thème WordPress universel, élégant et personnalisable conçu pour servir de base à tous vos sites : blog, vitrine, formation, séminaire, etc.

---

## Table des matières

1. [Caractéristiques](#caractéristiques)
2. [Installation](#installation)
3. [Configuration initiale](#configuration-initiale)
4. [Personnalisation](#personnalisation)
5. [Templates disponibles](#templates-disponibles)
6. [Blocs et patterns Gutenberg](#blocs-et-patterns-gutenberg)
7. [Palettes de couleurs](#palettes-de-couleurs)
8. [SEO et performances](#seo-et-performances)
9. [Structure des fichiers](#structure-des-fichiers)
10. [Duplication et réutilisation](#duplication-et-réutilisation)
11. [FAQ](#faq)
12. [Support](#support)

---

## Caractéristiques

### Design & Identité Visuelle

- ✨ Design épuré, vivant et lumineux
- 🎨 Palette de couleurs cohérente et personnalisable
- 🔤 Typographie exclusive **Poppins** (toutes graisses)
- 🎯 Espacement généreux et harmonie visuelle
- 📐 Arrondis doux (border-radius XL)
- 🌈 5 palettes pré-configurées + mode personnalisé

### Fonctionnalités WordPress

- ✅ Compatible **WordPress 6+** et **Gutenberg**
- 📱 **100% Responsive** (mobile-first)
- ⚡ **Performances optimisées** (lazy loading, minification)
- 🔍 **SEO-friendly** (Schema.org, Open Graph, métadonnées)
- ♿ **Accessible** (WCAG 2.1 AA)
- 🎨 **Customizer complet** (couleurs, typographie, layout)
- 🧩 **Blocs Gutenberg** stylisés
- 📦 **Sans dépendances lourdes**

### Templates spécialisés

- 📄 Page standard
- 📝 Article de blog
- 🎓 Formation
- 💼 Offre / Service
- 📧 Contact
- 🚀 Landing Page
- ❌ Page 404 personnalisée

---

## Installation

### Méthode 1 : Installation via WordPress

1. Téléchargez le fichier **insuffle-framework.zip**
2. Allez dans **Apparence > Thèmes > Ajouter**
3. Cliquez sur **Téléverser un thème**
4. Sélectionnez le fichier ZIP et cliquez sur **Installer maintenant**
5. Activez le thème

### Méthode 2 : Installation FTP

1. Décompressez le fichier **insuffle-framework.zip**
2. Téléchargez le dossier `insuffle-framework` dans `/wp-content/themes/`
3. Allez dans **Apparence > Thèmes**
4. Activez **Insuffle Framework**

---

## Configuration initiale

### 1. Logo et favicon

1. Allez dans **Apparence > Personnaliser > Identité du site**
2. Téléversez votre logo (recommandé : 400x100px, PNG transparent)
3. Téléversez votre favicon (512x512px)

### 2. Menus

1. Allez dans **Apparence > Menus**
2. Créez les menus suivants :
   - **Menu Principal** → Emplacement : `Menu Principal`
   - **Menu Footer** → Emplacement : `Menu Footer` (optionnel)
   - **Liens Sociaux** → Emplacement : `Liens Sociaux` (optionnel)

### 3. Widgets

1. Allez dans **Apparence > Widgets**
2. Configurez les zones de widgets :
   - **Sidebar** (barre latérale)
   - **Footer 1, 2, 3, 4** (colonnes du footer)

### 4. Page d'accueil

1. Créez une page "Accueil"
2. Allez dans **Réglages > Lecture**
3. Sélectionnez "Une page statique" et choisissez votre page "Accueil"

---

## Personnalisation

### Customizer WordPress

Allez dans **Apparence > Personnaliser** pour accéder à toutes les options :

#### Couleurs Insuffle

- **Palette de couleurs** : Choisissez parmi 5 palettes ou créez la vôtre
  - Par défaut (Bleu)
  - Vert
  - Rouge
  - Violet
  - Orange
  - Personnalisé

- **Couleur primaire** : Couleur principale du site
- **Couleur secondaire** : Couleur d'accentuation
- **Couleur d'accent** : Couleur pour les éléments importants

#### Typographie

- **Taille de police de base** : 12-24px (défaut : 16px)
- **Graisse des titres** : Light à Extra-Bold (défaut : Bold 700)
- **Hauteur de ligne** : 1.0 à 2.5 (défaut : 1.5)

#### En-tête

- **Disposition de l'en-tête** : Par défaut, Centré, Minimaliste
- **En-tête fixe (sticky)** : Activé par défaut
- **Bouton CTA** : Texte et URL personnalisables

#### Pied de page

- **Nombre de colonnes** : 1 à 4 colonnes
- **Texte du copyright** : Personnalisable
- **Afficher "Propulsé par Insuffle"** : Activé par défaut

#### Mise en page

- **Largeur du conteneur** : 960-1920px (défaut : 1280px)
- **Arrondi des coins** : 0-50px (défaut : 16px)
- **Espacement des sections** : 32-128px (défaut : 64px)

#### Blog

- **Disposition du blog** : Liste, Grille, Cartes
- **Afficher l'image à la une** : Oui/Non
- **Afficher les métadonnées** : Oui/Non
- **Afficher l'extrait** : Oui/Non

---

## Templates disponibles

### Page standard (`page.php`)

Template par défaut pour les pages.

**Options de page :**
- Hero plein écran (si image à la une)
- Masquer le titre
- Masquer l'image à la une
- Sidebar optionnelle

### Article de blog (`single.php`)

Template pour les articles de blog.

**Fonctionnalités :**
- Hero avec image à la une
- Métadonnées (date, auteur, catégories)
- Temps de lecture estimé
- Partage sur réseaux sociaux
- Navigation entre articles
- Articles similaires (3 max)
- Commentaires

### Formation (`templates/custom/formation.php`)

Template spécialisé pour les formations.

**Champs personnalisés (méta boxes) :**
- `_formation_duree` : Durée de la formation
- `_formation_niveau` : Niveau requis
- `_formation_prix` : Tarif

**Layout :**
- Contenu principal (gauche)
- Carte d'informations (droite, sticky)
- Bouton d'inscription

### Offre / Service (`templates/custom/offre.php`)

Template pour présenter vos offres et services.

**Champs personnalisés :**
- `_offre_avantages` : Liste des avantages
- `_offre_delai` : Délai de réalisation
- `_offre_tarif` : Tarif de départ

**Layout :**
- Contenu principal (gauche)
- Carte des points clés (droite, sticky)
- Bouton de demande de devis

### Contact (`templates/custom/contact.php`)

Template pour page de contact.

**Fonctionnalités :**
- Zone de formulaire (compatible Contact Form 7, Gravity Forms)
- Carte d'informations de contact
- Liens vers réseaux sociaux

**Options personnalisables (via Settings API) :**
- `insuffle_contact_email`
- `insuffle_contact_phone`
- `insuffle_contact_address`

### Landing Page (`templates/custom/landing.php`)

Template minimaliste pour landing pages.

**Caractéristiques :**
- Pas de header/footer
- Contenu pleine largeur
- Idéal pour les pages de conversion

### Page 404 (`404.php`)

Page d'erreur personnalisée.

**Fonctionnalités :**
- Message d'erreur clair
- Formulaire de recherche
- Liens utiles
- Articles récents (3)

---

## Blocs et patterns Gutenberg

### Blocs stylisés

Tous les blocs Gutenberg natifs sont stylisés pour correspondre au design Insuffle.

**Blocs spéciaux :**
- **Boutons** : Styles personnalisés (Contour, Ghost)
- **Groupes** : Styles Carte et Highlight
- **Citations** : Bordure gauche colorée
- **Colonnes** : Espacement harmonieux

### Patterns disponibles

#### Hero Section
Section hero pleine largeur avec titre, description et CTA.

#### Call-to-Action
Section CTA avec fond coloré et bouton.

#### Fonctionnalités 3 colonnes
Grille de 3 colonnes pour présenter des fonctionnalités.

#### Témoignage
Citation stylisée avec bordure colorée.

#### FAQ
Section Questions/Réponses avec séparateurs.

---

## Palettes de couleurs

### Palette par défaut (Bleu Insuffle)

| Usage | Couleur | Hex |
|-------|---------|-----|
| Primaire | Bleu Insuffle | `#1f3a8b` |
| Primaire clair | | `#dee2f1` |
| Primaire foncé | | `#0d1a4f` |
| Secondaire | Jaune Insuffle | `#ffde59` |
| Secondaire clair | | `#fff3b3` |
| Secondaire foncé | | `#c9a600` |
| Accent | Rouge | `#ff5959` |
| Accent clair | | `#ffdede` |
| Accent foncé | | `#8b1f1f` |

### Autres palettes

Le thème inclut 4 autres palettes pré-configurées :
- **Vert** : Palette nature et écologie
- **Rouge** : Palette dynamique et énergique
- **Violet** : Palette créative et moderne
- **Orange** : Palette chaleureuse et conviviale

Chaque palette génère automatiquement des nuances claires et foncées.

---

## SEO et performances

### SEO

Le thème intègre nativement :

- ✅ **Métadonnées complètes** (title, description)
- ✅ **Open Graph** (Facebook, LinkedIn)
- ✅ **Twitter Cards**
- ✅ **Schema.org / JSON-LD** (Article, Website, Breadcrumb)
- ✅ **Balises canoniques**
- ✅ **Fil d'Ariane** (breadcrumb)
- ✅ **Sitemap XML** (via WordPress natif)

### Performances

- ⚡ **Lazy loading** des images (natif HTML)
- ⚡ **Minification** recommandée (via plugin)
- ⚡ **Cache** compatible (WP Super Cache, W3 Total Cache)
- ⚡ **CDN** compatible
- ⚡ **Polices Google Fonts** chargées avec `display=swap`

### Recommandations plugins

- **SEO** : Yoast SEO ou Rank Math
- **Cache** : WP Super Cache ou WP Rocket
- **Images** : Smush ou ShortPixel
- **Formulaires** : Contact Form 7 ou Gravity Forms

---

## Structure des fichiers

```
insuffle-framework/
├── style.css                    # Métadonnées + variables CSS
├── theme.json                   # Design system Gutenberg
├── functions.php                # Setup WordPress
├── header.php                   # En-tête
├── footer.php                   # Pied de page
├── index.php                    # Template principal
├── page.php                     # Template page
├── single.php                   # Template article
├── archive.php                  # Template archive
├── front-page.php               # Template page d'accueil
├── 404.php                      # Template erreur 404
├── searchform.php               # Formulaire de recherche
├── comments.php                 # Commentaires
├── screenshot.png               # Aperçu du thème (1200x900px)
│
├── assets/
│   ├── css/
│   │   ├── global.css           # Styles globaux
│   │   ├── components.css       # Composants
│   │   ├── responsive.css       # Media queries
│   │   └── editor-style.css     # Styles éditeur Gutenberg
│   ├── js/
│   │   ├── navigation.js        # Navigation & menu mobile
│   │   ├── main.js              # Scripts principaux
│   │   └── customizer.js        # Preview Customizer
│   ├── images/                  # Images du thème
│   └── fonts/                   # Polices (si nécessaire)
│
├── inc/
│   ├── customizer.php           # Options Customizer
│   ├── options.php              # Panneau d'options
│   ├── template-functions.php   # Fonctions template
│   ├── blocks.php               # Blocs et patterns
│   └── seo.php                  # SEO et Schema.org
│
├── templates/
│   └── custom/
│       ├── landing.php          # Template Landing Page
│       ├── formation.php        # Template Formation
│       ├── offre.php            # Template Offre/Service
│       └── contact.php          # Template Contact
│
└── template-parts/
    ├── content.php              # Contenu article
    └── content-none.php         # Aucun résultat
```

---

## Duplication et réutilisation

### Pour créer un nouveau site

1. **Dupliquez le dossier du thème**
   ```bash
   cp -r insuffle-framework mon-nouveau-site-theme
   ```

2. **Renommez le thème**
   - Ouvrez `style.css`
   - Changez `Theme Name:` vers le nom de votre nouveau site
   - Changez `Text Domain:` si nécessaire

3. **Personnalisez la palette**
   - Allez dans **Apparence > Personnaliser > Couleurs Insuffle**
   - Choisissez une palette ou créez la vôtre

4. **Uploadez logo et favicon**
   - **Apparence > Personnaliser > Identité du site**

5. **Configurez le contenu**
   - Créez vos pages, menus, widgets

### Variables CSS à personnaliser

Les variables CSS principales sont dans `style.css` (lignes 22-100).

Vous pouvez les surcharger via le Customizer ou directement dans le fichier.

---

## FAQ

### Comment changer la couleur principale ?

**Via le Customizer :**
1. Allez dans **Apparence > Personnaliser > Couleurs Insuffle**
2. Sélectionnez "Personnalisé" dans "Palette de couleurs"
3. Choisissez votre couleur primaire

### Comment ajouter un formulaire de contact ?

1. Installez **Contact Form 7** ou **Gravity Forms**
2. Créez votre formulaire
3. Créez une page avec le template "Contact"
4. Insérez le shortcode du formulaire dans le contenu

### Comment activer le mode sombre ?

Le thème n'inclut pas de mode sombre par défaut, mais vous pouvez l'ajouter en créant un thème enfant et en surchargeant les variables CSS avec `@media (prefers-color-scheme: dark)`.

### Comment désactiver la sidebar ?

La sidebar est désactivée automatiquement sur :
- Page d'accueil
- Landing pages
- Si la zone de widget "Sidebar" est vide

### Comment modifier le footer ?

1. **Colonnes :** **Apparence > Personnaliser > Pied de page**
2. **Widgets :** **Apparence > Widgets** (Footer 1, 2, 3, 4)
3. **Copyright :** **Apparence > Personnaliser > Pied de page > Texte du copyright**

### Comment ajouter Google Analytics ?

Utilisez un plugin comme **Site Kit by Google** ou ajoutez le code directement dans `header.php` (ou mieux, dans un thème enfant).

### Le thème est-il compatible avec WooCommerce ?

Le thème n'inclut pas de support WooCommerce natif, mais vous pouvez l'ajouter via un thème enfant en déclarant le support :

```php
add_theme_support( 'woocommerce' );
```

---

## Support

### Documentation

- **Site officiel :** [https://insuffle.com](https://insuffle.com)
- **GitHub :** [https://github.com/insuffle/insuffle-framework](https://github.com/insuffle/insuffle-framework)

### Problèmes et bugs

Si vous rencontrez un problème, veuillez :
1. Vérifier la [FAQ](#faq)
2. Consulter les [issues GitHub](https://github.com/insuffle/insuffle-framework/issues)
3. Ouvrir une nouvelle issue si nécessaire

### Changelog

**Version 1.0.0 (2025-01-XX)**
- Version initiale
- Support WordPress 6+
- Support Gutenberg complet
- 5 palettes de couleurs
- 6 templates personnalisés
- Customizer complet
- SEO et Schema.org intégrés

---

## Licence

Ce thème est distribué sous licence **GPL v2 or later**.

```
Insuffle Framework WordPress Theme, (C) 2025 Insuffle
Insuffle Framework is distributed under the terms of the GNU GPL v2 or later.
```

---

## Crédits

- **Typographie :** [Poppins](https://fonts.google.com/specimen/Poppins) par Google Fonts
- **Icons :** Intégrés via SVG natif
- **Développement :** Insuffle Team

---

**Made with ❤️ by Insuffle**
