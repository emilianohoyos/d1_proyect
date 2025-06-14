<?php

return [

  /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

  'menu' => [
    [
      'text' => 'Home',
      'is_header' => true
    ],
    [
      'url' => '/',
      'icon' => 'fa fa-calendar',
      'text' => 'Calendario'
    ],
    // [
    //   'url' => '/analytics',
    //   'icon' => 'fa fa-chart-pie',
    //   'text' => 'Analytics'
    // ],
    // [
    //   'icon' => 'fa fa-envelope',
    //   'text' => 'Email',
    //   'label' => '6',
    //   'children' => [[
    //     'url' => '/email/inbox',
    //     'action' => 'Inbox',
    //     'text' => 'Inbox'
    //   ], [
    //     'url' => '/email/compose',
    //     'action' => 'Compose',
    //     'text' => 'Compose'
    //   ], [
    //     'url' => '/email/detail',
    //     'action' => 'Detail',
    //     'text' => 'Detail'
    //   ]]
    // ],
    [
      'is_divider' => true
    ],
    [
      'text' => 'Navegación',
      'is_header' => true
    ],
    [

      'icon' => 'fa fa-user',
      'text' => 'Empleados',
      'children' => [
        [
          'url' => '/employee/create',
          'text' => 'Crear'
        ],
        [
          'url' => '/employee',
          'text' => 'Listar'
        ],

      ]
    ],
    [

      'icon' => 'fa fa-shopping-cart',
      'text' => 'Tiendas',
      'children' => [
        [
          'url' => '/store/create',
          'text' => 'Crear'
        ],
        [
          'url' => '/store',
          'text' => 'Listar'
        ],

      ]
    ],
    [

      'icon' => 'fa fa-route',
      'text' => 'Rutas',
      'children' => [
        [
          'url' => '/route/create',
          'text' => 'Crear'
        ],
        [
          'url' => '/route',
          'text' => 'Listar'
        ],

      ]
    ],
    [

      'icon' => 'fa fa-calendar',
      'text' => 'Programación',
      'children' => [
        [
          'url' => '/route-schedule/create',
          'text' => 'Crear'
        ],
        [
          'url' => '/route-schedule/search',
          'text' => 'Listar'
        ],

      ]
    ],
    [

      'icon' => 'fas fa-map-marker-alt',
      'text' => 'Barrios',
      'children' => [
        [
          'url' => '/neighborhood/create',
          'text' => 'Crear'
        ],
        [
          'url' => '/neighborhood',
          'text' => 'Listar'
        ],

      ]
    ],
    // [
    //   'url' => '/widgets',
    //   'icon' => 'fa fa-qrcode',
    //   'text' => 'Widgets'
    // ],
    // [
    //   'icon' => 'fa fa-wallet',
    //   'text' => 'POS System',
    //   'children' => [[
    //     'url' => '/pos/customer-order',
    //     'text' => 'Customer Order'
    //   ], [
    //     'url' => '/pos/kitchen-order',
    //     'text' => 'Kitchen Order'
    //   ], [
    //     'url' => '/pos/counter-checkout',
    //     'text' => 'Counter Checkout'
    //   ], [
    //     'url' => '/pos/table-booking',
    //     'text' => 'Table Booking'
    //   ], [
    //     'url' => '/pos/menu-stock',
    //     'text' => 'Menu Stock'
    //   ]]
    // ],
    // [
    //   'icon' => 'fa fa-heart',
    //   'text' => 'UI Kits',
    //   'children' => [[
    //     'url' => '/ui/bootstrap',
    //     'action' => 'Bootstrap',
    //     'text' => 'Bootstrap'
    //   ], [
    //     'url' => '/ui/buttons',
    //     'text' => 'Buttons'
    //   ], [
    //     'url' => '/ui/card',
    //     'text' => 'Card'
    //   ], [
    //     'url' => '/ui/icons',
    //     'text' => 'Icons'
    //   ], [
    //     'url' => '/ui/modal-notifications',
    //     'text' => 'Modal & Notifications'
    //   ], [
    //     'url' => '/ui/typography',
    //     'text' => 'Typography'
    //   ], [
    //     'url' => '/ui/tabs-accordions',
    //     'text' => 'Tabs & Accordions'
    //   ]]
    // ],
    // [
    //   'icon' => 'fa fa-file-alt',
    //   'text' => 'Forms',
    //   'children' => [[
    //     'url' => '/form/elements',
    //     'text' => 'Form Elements'
    //   ], [
    //     'url' => '/form/plugins',
    //     'text' => 'Form Plugins'
    //   ], [
    //     'url' => '/form/wizards',
    //     'text' => 'Wizards'
    //   ]]
    // ],
    // [
    //   'icon' => 'fa fa-table',
    //   'text' => 'Tables',
    //   'children' => [
    //     [
    //       'url' => '/table/elements',
    //       'text' => 'Table Elements'
    //     ],
    //     [
    //       'url' => '/table/plugins',
    //       'text' => 'Table Plugins'
    //     ]
    //   ]
    // ],
    // [
    //   'icon' => 'fa fa-chart-bar',
    //   'text' => 'Charts',
    //   'children' => [[
    //     'url' => '/chart/chart-js',
    //     'text' => 'Chart.js'
    //   ], [
    //     'url' => '/chart/chart-apex',
    //     'text' => 'Apexcharts.js'
    //   ]]
    // ],
    // [
    //   'url' => '/map',
    //   'icon' => 'fa fa-map-marker-alt',
    //   'text' => 'Map'
    // ],
    // [
    //   'url' => 'Layout',
    //   'icon' => 'fa fa-code-branch',
    //   'text' => 'Layout',
    //   'children' => [[
    //     'url' => '/layout/starter-page',
    //     'text' => 'Starter Page'
    //   ], [
    //     'url' => '/layout/fixed-footer',
    //     'text' => 'Fixed Footer'
    //   ], [
    //     'url' => '/layout/full-height',
    //     'text' => 'Full Height'
    //   ], [
    //     'url' => '/layout/full-width',
    //     'text' => 'Full Width'
    //   ], [
    //     'url' => '/layout/boxed-layout',
    //     'text' => 'Boxed Layout'
    //   ], [
    //     'url' => '/layout/minified-sidebar',
    //     'text' => 'Minified Sidebar'
    //   ], [
    //     'url' => '/layout/top-nav',
    //     'text' => 'Top Nav'
    //   ], [
    //     'url' => '/layout/mixed-nav',
    //     'text' => 'Mixed Nav'
    //   ], [
    //     'url' => '/layout/mixed-nav-boxed-layout',
    //     'text' => 'Mixed Nav Boxed Layout'
    //   ]]
    // ],
    // [
    //   'icon' => 'fa fa-globe',
    //   'text' => 'Pages',
    //   'children' => [[
    //     'url' => '/page/scrum-board',
    //     'text' => 'Scrum Board'
    //   ], [
    //     'url' => '/page/products',
    //     'text' => 'Products'
    //   ], [
    //     'url' => '/page/product/details',
    //     'text' => 'Product Details'
    //   ], [
    //     'url' => '/page/orders',
    //     'text' => 'Orders'
    //   ], [
    //     'url' => '/page/order/details',
    //     'text' => 'Order Details'
    //   ], [
    //     'url' => '/page/gallery',
    //     'text' => 'Gallery'
    //   ], [
    //     'url' => '/page/search-results',
    //     'text' => 'Search Results'
    //   ], [
    //     'url' => '/page/coming-soon',
    //     'text' => 'Coming Soon Page'
    //   ], [
    //     'url' => '/page/error',
    //     'text' => 'Error Page'
    //   ], [
    //     'url' => '/page/login',
    //     'text' => 'Login'
    //   ], [
    //     'url' => '/page/register',
    //     'text' => 'Register'
    //   ], [
    //     'url' => '/page/messenger',
    //     'text' => 'Messenger'
    //   ], [
    //     'url' => '/page/data-management',
    //     'text' => 'Data Management'
    //   ], [
    //     'url' => '/page/file-manager',
    //     'text' => 'File Manager'
    //   ], [
    //     'url' => '/page/pricing',
    //     'text' => 'Pricing Page'
    //   ]]
    // ],
    // [
    //   'url' => '/landing',
    //   'icon' => 'fa fa-crown',
    //   'text' => 'Landing Page'
    // ],
    // [
    //   'is_divider' => true
    // ],
    // [
    //   'text' => 'Users',
    //   'is_header' => true
    // ],
    // [
    //   'url' => '/profile',
    //   'icon' => 'fa fa-user-circle',
    //   'text' => 'Profile'
    // ],
    // [
    //   'url' => '/calendar',
    //   'icon' => 'fa fa-calendar',
    //   'text' => 'Calendar'
    // ],
    // [
    //   'url' => '/settings',
    //   'icon' => 'fa fa-cog',
    //   'text' => 'Settings'
    // ],
    // [
    //   'url' => '/helper',
    //   'icon' => 'fa fa-question-circle',
    //   'text' => 'Helper'
    // ]
  ]
];
