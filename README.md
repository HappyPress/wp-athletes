# wp-athletes


wp-athletes-plugin/
├── wp-athletes-plugin.php *
├── README.md
├── includes/
│   ├── custom-fields.php *
│   ├── custom-post-types.php *
│   ├── custom-taxonomies.php * 
│   ├── import-export.php *
│   ├── dependencies.php *
│   ├── search-functions.php             # New file to handle search functionalities
├── admin/
│   ├── admin-pages.php
│   ├── enqueue-scripts.php
├── assets/
│   ├── css/
│   │   ├── admin.css
│   │   ├── style.css                    # New file for front-end styles
│   └── js/
│       ├── admin.js
│       ├── search.js                    # New file for handling search interactions
├── templates/
│   ├── single-athlete.php
│   ├── taxonomy-discipline.php
│   ├── taxonomy-team.php
│   ├── archive-athlete.php               # New template for athlete archive
│   ├── athlete-search-form.php           # New template for search form
└── blocks/                               # New directory for Gutenberg blocks
    ├── athlete-profile/
    │   ├── index.php
    │   ├── block.json
    │   ├── editor.css
    │   ├── style.css
    ├── athlete-list/
        ├── index.php
        ├── block.json
        ├── editor.css
        ├── style.css


