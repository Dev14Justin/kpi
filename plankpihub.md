### KpiHub — Plan de développement complet (Laravel + MySQL)

Ce document décrit en détail le projet KpiHub : une plateforme SaaS pour les influenceurs et les marques permettant au influenceurs de créer leurs portfolios, suivre et évaluer leurs campagnes de marketing sur les réseaux sociaux. Il est rédigé pour aider un agent IA de développement ou une équipe afin qu’il comprenne exactement quoi, pourquoi et comment développer la plateforme.

### 1. Contexte & vision
Contexte

KpiHub est une plateforme web(Saas) qui centralise les influenceurs, met à leur disposition des outils professionnels pour valoriser leur travail, et mesure l'impact de leurs performances marketing. Elle permet également aux marques et entreprises de mesurer efficacement l'impact des campagnes de placement de produits et de trouver facilement des influenceurs performants selon leurs catégories et plusieurs critères de sélection.

C'est un outil qui permettra aux influenceurs de créer leur portfolio dynamique, de gérer leurs profil KPI interactif, et d'avoir un dashboard qui leur permettra de gérer leur compte.

L'objectif est de faire de cette plateforme une référence en matière de preuve d'efficacité marketing pour les réseaux sociaux (TikTok, Instagram, YouTube, et Linkedin).

### Vision

Créer une référence en matière de preuve d’efficacité marketing pour les réseaux sociaux, en proposant une plateforme moderne, sécurisée et intuitive, où influenceurs et marques peuvent collaborer facilement, avec suivi précis des résultats.

### 🛑 **Problème ciblé**

- Les influenceurs manquent d'outils clairs et professionnels pour prouver leur efficacité.

- Les marques ont du mal à évaluer les résultats réels des collaborations et à trouver des influenceurs efficaces selon plusieurs catégories de filtrage (le type de contenu que l'influenceur crée, le type de communauté qu'il possède, son taux de conversion et bien d'autres indicateurs de performance, ainsi que tous les éléments qui peuvent entrer en jeu dans un placement de produits).

- Les discussions se basent souvent sur des chiffres déclaratifs, non structurés et non vérifiés.

### ✅ **Solution proposée**

Une plateforme où :

### **Pour l'influenceur :**
- Il crée un portfolio numérique avec ses campagnes passées et leurs performances
- Un profil utilisateur KPI affiche automatiquement les métriques clés (engagement, vues, conversions, ROI…) et les campagnes qui seront déclarées sur la plateforme
- Un dashboard où chaque utilisateur peut gérer lui-même son compte, en gérant son profil public, créer et gérer son portfolio, un outil pour créer une campagne de placement de produit qui permettra de déclarer une nouvelle campagne pour avoir la possibilité de créer un formulaire d'inscription personnalisé, en utilisant du glisser-déposer pour chaque campagne déclarée

#### **Fonctionnalités de partage et collecte de données :**
- L'influenceur peut partager un lien public vers son portfolio, vers son profil de la plateforme
- Creation d'un formulaire pour colecter les leads pour chaque campagne déclarée sur la plateforme
- Les données collectées à travers ce formulaire seront automatiquement formatées dans un Google Sheet qui sera accessible via un bouton "Connecter à Google Sheet" où l'utilisateur pourra se connecter à son compte Google Sheet pour voir les données recueillies à travers le formulaire créé

### **Pour les marques :**
- Elles peuvent contacter directement les influenceurs à travers la Marketplace qui sera la page d'atterrissage après connexion, et sur leurs profils

### Objectifs principaux

Portfolio dynamique pour influenceurs (campagnes Réalisé, KPIs,.......)
Marketplace influenceurs
Dashboard KPI interactif
Création et suivi des campagnes
Gestion des utilisateurs, rôles et permissions
Gamification (badges, récompenses)
Design moderne, thème clair/sombre, responsive

## Fonctionnalités

### 🔑 Authentification & Utilisateurs
- Inscription / Connexion (influenceurs, entreprises, particuliers)
- Gestion des profils (bio, photo/logo, réseaux sociaux, niche)

### 📂 Portfolio Influenceur
- Ajout manuel de campagnes (Nom, Plateforme, Date)
- Ajout automatique de campagnes (Nom, Plateforme, Date, suivi statistique, à travers le lien de formulaire généré, et le lien du contenu qui a servi à faire la publicité sur le réseau social en question)
- Organisation par catégories (TikTok, Instagram, YouTube…)
- Génération d'un lien public partageable du portfolio

### 📊 Profil et portfolio KPI
- Visualisation des campagnes sous forme de graphiques et indicateurs clés (CTR, CPM, ROI, taux d'engagement)
- Comparaison des performances entre campagnes
- Données mockées (JSON) → API intégrée

### Dashboard
- Outil de gestion du compte
- Outil de création de portfolio
- Outil de création de campagne a travers un formulaire d'inscription

### 📝 Formulaires de placement de produit
- L'influenceur peut cree un formulaire pour suvre un commapagne et captiver les lead (nom de la marque, type de produit, budget, objectif de la campagne, nom des leads, prenom, mail, tel, etc)
- Les marques peuvent soumettre une collaboration via une prise de contact ou invitation. 

### 🔮 Fonctionnalités
- Marketplace Influenceurs ↔ Marques (recherche par niche, audience, etc.)
- API TikTok/Instagram/YouTube/Linkeding pour récupérer automatiquement les statistiques
- Gamification (badges pour influenceurs : "Top Conversion", "High Engagement")
- Analytics côté marques (suivi des campagnes avec les influenceurs avec lesquels ils collaborent)

### 2. Public cible & personas

- Influenceurs : veulent prouver leur performance marketing, créer un portfolio interactif et valoriser leurs campagnes.
- Marques / entreprises : veulent trouver et contacter les influenceurs les plus performants et suivre leurs campagnes.
- Agences marketing : veulent centraliser et analyser les KPIs de leurs clients et influenceurs.

### 4 Admin (Avec Filaments)

- Paramètres globaux de la plateforme
- Gestion de toute la platforme et des utilisateur
- Accès complet à tous les logs et statistiques

### 4. Stack technique

### Backend / Fullstack
Framework : Laravel
Langage : PHP 8
Base de données : MySQL
ORM : Eloquent
Gestion des rôles : Laravel Sanctum / Laravel Breeze pour Auth, JWT pour API
API : REST pour front et intégrations externes

### Frontend
Framework : Blade + Laravel Mix OR Inertia.js 
UI/UX : TailwindCSS, Shadcn (composants avancés) (design moderne, responsive, SaaS-like)
Graphiques : Chart.js ou Recharts
Animations : Framer Motion 

### 🎨 Style attendu
- Interface moderne, minimaliste et intuitive
- Responsive (mobile-first)
- Navigation fluide avec layouts cohérents (Navbar, Sidebar, Footer)
- Expérience type SaaS Dashboard

### Paiement

Mobile Money Togo (TMoney, Flooz via API)
Carte bancaire (Visa/Mastercard via)
Webhooks sécurisés pour mise à jour commandes

Hébergement

Backend + Base de données : 
Frontend / Assets : intégré au backend Laravel
Fichiers multimédia (images, vidéos) : CDN ou S3
CI/CD : GitHub Actions

### 5. Architecture & flux

Frontend : Blade, accessible au public pour catalogue, portfolios,..... etc 
Backend : Laravel API pour gestion des données, Auth, paiements
Base de données : MySQL pour tous les utilisateurs, campagnes, formulaires, KPIs
Actions Authentifiées : Laravel Sanctum pour tokens et API sécurisée

### Paiement : Webhooks TMoney/Flooz/ → Backend Laravel → mise à jour commandes → notification email

### 6. Schéma de base de données (MySQL) ( Peuve etre ameliorer pour les bonnes performence )
users
id | name | email | password | role ('influencer','brand','admin','superadmin') | created_at | updated_at

portfolios
id | user_id | title | description | slug | created_at | updated_at

campaigns
id | portfolio_id | title | description | form_link | start_date | end_date | kpi_data (JSON) | created_at | updated_at

badges
id | user_id | badge_type | campaign_id | awarded_at

forms
id | campaign_id | fields (JSON) | submission_data (JSON) | created_at | updated_at

orders
id | user_id | campaign_id | amount | status ('pending','paid','failed') | payment_method | created_at | updated_at

audit_logs
id | user_id | action | metadata (JSON) | created_at

### 7. Sécurité

Auth JWT via Laravel Sanctum
Middleware pour vérifier les rôles (Influencer / Brand / Admin)
Validation stricte côté serveur (Laravel Validation)
Webhooks sécurisés pour paiements
HTTPS obligatoire

### 8. Structure du projet (arborescence Laravel recommandée)
kpi-hub/
├─ app/
│  ├─ Http/Controllers/
│  ├─ Models/
│  ├─ Middleware/
├─ resources/
│  ├─ views/      # Blade templates
│  ├─ js/         # Vue / React + Tailwind
│  ├─ css/
├─ database/
│  ├─ migrations/
│  ├─ seeders/
├─ routes/
│  ├─ web.php
│  ├─ api.php
├─ storage/
├─ tests/
├─ .env.example
├─ composer.json

### 📌 Résultats attendus
À la fin du développement, nous devons avoir :
- Un système d'authentification fonctionnel
- Une page de marketplace qui sera la page d'atterrissage après connexion à la plateforme où seront répertoriées toutes les personnes inscrites comme influenceurs
- Une page de Gamification (badges pour influenceurs : "Top Conversion", "High Engagement")
- Un Dashboard KPI avec graphiques interactifs dans lequel on peut gérer son compte, son profil KPI-Hub, son portfolio, créer des campagnes et des formulaires
- etc .................

### 9. Pages & routes

### Public
/ : accueil, hero, Fonctionnalités, Pour les Influenceurs, Pour les Marques, ect.......
/marketplace : liste influenceurs avec filtres
/about
/contact, /terms, /privacy

### Authentifié
/dashboard : gestion du compte, KPIs, portfolio
/marketplace : liste tout les influenceurs avec filtres et padination de la page
/portfolio/{slug} : portfolio public
/campaigns : création et suivi campagnes
/forms/{id} : gestion formulaires

### Admin ( Creation avec Filament plugin de laravel pour la gestion d'es platforme )
/admin : Toute les statistiques
/admin/users : CRUD utilisateurs et des administrateur
/admin/badges : gestion badges
/admin/settings : paramètres globaux
/admin/etc.......................(Tu peut ajouter ce que tu trouve nessaire)

### 10. UI / UX / Branding
Palette identique à KpiHub : vert #00D084, rose #FF4FA2, gris clair #FAFAFA, noir #1C1C1C
Thème clair / sombre
Typographie : Inter / Urbanist
Dashboard moderne avec graphiques, cartes, tableaux
Navigation fluide, responsive (mobile-first)
Animations douces avec Framer Motion

### 11. Tests & QA
Tests unitaires Laravel (PHPUnit) pour modèles et services
Tests d’intégration pour API et workflows de campagne
Tests E2E pour parcours critiques (auth, création campagne, formulaire, paiement)
Revue manuelle avant release

### 12. CI/CD & déploiement
GitHub Actions : lint, tests, build, migration DB
Déploiement sur Render/DigitalOcean
Variables d’environnement dans .env (DB, clés paiement, JWT secret, API externes)
Migration automatique avec artisan lors du deploy

### 13. Livrables attendus
Projet fonctionnel (Influencer, Brand, Admin)
Dashboard fonctionnel
Admin fonctionnel
Marketplace et portfolio public
Paiement Mobile Money et carte simulé
KPIs et graphiques interactifs

---
# 🎨 Fiche de style – KpiHub (Mode clair + Mode sombre)

## 1. Typographie
- **Police principale :** Inter ou Urbanist (Google Fonts)
- **Taille de base :** 16px → text-base, text-lg, text-xl, text-3xl pour la hiérarchie
- **Espacement :** tracking-wide pour titres & CTA
- **Poids :**
  - Titres : font-semibold ou font-bold
  - Corps : font-normal ou font-medium

## 2. Palette de couleurs

### Mode clair
- **Primaire (Vert fluo) :** #00D084 → Boutons, CTA
- **Primaire hover :** #00a86b (version plus sombre du vert fluo)
- **Accent (Rose fuchsia) :** #FF4FA2 → tags, éléments marquants
- **Fond principal :** #FAFAFA
- **Sections contrastées (cards, composants) :** #FFFFFF
- **Texte principal :** #1C1C1C
- **Texte secondaire :** #6B7280
- **Accent doux (badge, état positif) :** #E0FFF4 (vert clair dérivé)

### Mode sombre
- **Primaire (Vert fluo) :** #00D084 → CTA, liens actifs
- **Primaire hover :** #00a86b
- **Accent (Rose fuchsia) :** #FF4FA2 → badges, highlights
- **Fond principal :** #1C1C1C
- **Sections contrastées (cards, composants) :** #2E2E2E
- **Texte principal :** #FFFFFF
- **Texte secondaire :** #9CA3AF
- **Accent doux (badge) :** #2E2E2E avec texte vert

## 3. Boutons
- **Taille :** py-3 px-6
- **Forme :** rounded-xl
- **Ombre :** shadow-md
- **Effet hover :** hover:bg-[#00a86b] transition duration-200

### Exemples

**Mode clair :**
```jsx
<Button className="bg-[#00D084] text-white font-semibold rounded-xl px-6 py-3 shadow hover:bg-[#00a86b] transition">
  Créer mon Portfolio
</Button>
```

**Mode sombre :**
```jsx
<Button className="bg-[#00D084] text-black font-semibold rounded-xl px-6 py-3 shadow hover:bg-[#00a86b] transition">
  Créer mon Portfolio
</Button>
```

## 4. Layout
- **Conteneur principal :** max-w-7xl mx-auto
- **Grilles :** md:grid-cols-2, lg:grid-cols-3 selon les sections
- **Espacements :**
  - Vertical : py-6, py-12, lg:py-16
  - Horizontal : px-4, md:px-8

## 5. Icônes
Utiliser lucide-react (modernes, légères, accessibles) 

## 6. Exemples d'application

### Badge "Payé"

**Clair :**
```jsx
<span className="bg-[#E0FFF4] text-[#00a86b] px-3 py-1 text-sm rounded-full font-medium">
  Payé
</span>
```

**Sombre :**
```jsx
<span className="bg-[#2E2E2E] text-[#00D084] px-3 py-1 text-sm rounded-full font-medium">
  Payé
</span>
```

### Avatar cercle
```jsx
<div className="w-12 h-12 rounded-full overflow-hidden border-2 border-[#00D084]">
  <img src="{{ chemin d'acces vert l'image }}" alt="User" className="object-cover w-full h-full" />
</div>
```

## 7. Basculer entre clair et sombre (Tailwind)

Nous utiliserons le mode sombre natif de Tailwind :
- Ajouter `darkMode: "class"` dans tailwind.config.js
- Gérer avec un toggle (ajout d'une classe dark sur `<html>`)

### Exemple d'utilisation :
```jsx
<div className="bg-white text-[#1C1C1C] dark:bg-[#1C1C1C] dark:text-white">
  <h1 className="text-3xl font-bold">Bienvenue sur KpiHub</h1>
</div> 

## 🎨 Design
- Look SaaS moderne et épuré
- Dashboard KPI avec cartes, graphiques et tableaux clairs
- Mode mobile-first, responsive
- Expérience utilisateur fluide (navigation simple, peu de friction) ect ......

```

### Ce que tu NE DOIS PAS faire :

- Ne pas utiliser de gradients ou couleurs non listées.
- Ne pas inclure d’emojis ni de contenus informels dans l’UI.

### 14. Rôles & responsabilités

Agent IA / Développeur : implémentation Laravel + MySQL, frontend (Blade), paiements, API, tests, documentation

Product Owner : décisions contrats, contenus portfolio, pricing, validations UX

Opérations : support client, gestion campagnes et badges

15. Prompt directive à l’agent IA

Tu es un assistant développeur IA spécialisé en Laravel fullstack.
Ta mission : implémenter et livrer KpiHub suivant ce plan détaillé.
Travaille étape par étape, propose un plan d’action découpé en tâches, exécute les fonctionnalités avec code propre, et testable.

Contraintes UI/UX & Branding : respecter palette, typographie, thème clair/sombre, design dashboard SaaS moderne.

Fonctionnalités critiques : auth, dashboard KPI, portfolio, marketplace, campagnes, formulaires, paiements, Admin

Livrables : environnement dev, staging, production, tests, et démo fonctionnelle.