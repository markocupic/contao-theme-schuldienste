# CLAUDE.md — Schuldienste Theme

Dieses Dokument enthält wichtige Informationen für die KI-Assistenz (Claude Code) beim Arbeiten an diesem Contao-Theme-Bundle.

## Projektstruktur

```
assets/scss/
├── main.scss              # Einstiegspunkt — alle Imports
├── variables.scss         # SCSS-Variablen (Bootstrap-Overrides)
├── root.scss              # CSS Custom Properties (:root)
├── functions/             # SCSS-Funktionen (clamp-calc etc.)
├── mixins/                # SCSS-Mixins (icon-before etc.)
└── components/            # Eine Datei pro Komponente
```

## Farben & Design

### Akzentfarbe
- Orange `#fd6b22` ist die Markenfarbe — **nicht ändern**
- Wird über `$accent-color` / `$primary` / `var(--accent-color)` gesetzt

### Light Mode
- Seiten-Hintergrund: `$body-bg: #f0f2f5` (kühles Blau-Grau)
- Content-Bereiche: `$body-tertiary-bg: #fff` (weißer Layout-Wrapper)
- Cards/Boxen: `$light: #f8f9fa`
- Text: `$body-color: #2c3e50`
- Ziel: **hoher Weißanteil**, kühle (nicht warme) Grautöne

### Dark Mode
Dreistufige Hintergrund-Hierarchie (außen → innen → Karten):

| Ebene | Wert | Verwendung |
|---|---|---|
| Außen | `#0f1115` | `$body-bg-dark` — Seite außerhalb des Wrappers |
| Content | `#1a1e27` | `$body-tertiary-bg-dark` — Layout-Wrapper, Header |
| Karten | `#252a35` | `--box-bg-light`, `--bs-card-bg` |

- Text: `$body-color-dark: #dde0e4` (sanftes Weiß, nicht blendend)
- Nav-Text: `--menu-color: #c8ccd2`
- Headings: `--bs-heading-color: #e4e6ea`

## Coding-Hinweise

- SCSS-Dateien im `components/`-Ordner haben einen Unterstrich-Prefix (`_name.scss`), werden aber in `main.scss` ohne Unterstrich importiert
- `clamp-calc(min, max)` ist eine eigene Funktion aus `functions/_functions.scss` für fluid typography/spacing
- Bootstrap-Variablen werden in `variables.scss` überschrieben, **bevor** Bootstrap importiert wird
- CSS Custom Properties (`--var`) werden in `root.scss` definiert und überschreiben Bootstrap-Root-Vars
