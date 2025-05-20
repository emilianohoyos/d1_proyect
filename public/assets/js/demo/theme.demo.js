// Theme configuration
const themeConfig = {
    // Color schemes
    colors: {
        primary: '#0d6efd',
        secondary: '#6c757d',
        success: '#198754',
        info: '#0dcaf0',
        warning: '#ffc107',
        danger: '#dc3545',
        light: '#f8f9fa',
        dark: '#212529'
    },

    // Layout options
    layout: {
        header: {
            fixed: true,
            inverse: false
        },
        sidebar: {
            fixed: true,
            collapsed: false,
            inverse: false
        },
        content: {
            boxed: false
        }
    },

    // Apply theme
    apply: function () {
        // Apply color scheme
        document.documentElement.style.setProperty('--bs-primary', this.colors.primary);
        document.documentElement.style.setProperty('--bs-secondary', this.colors.secondary);
        document.documentElement.style.setProperty('--bs-success', this.colors.success);
        document.documentElement.style.setProperty('--bs-info', this.colors.info);
        document.documentElement.style.setProperty('--bs-warning', this.colors.warning);
        document.documentElement.style.setProperty('--bs-danger', this.colors.danger);
        document.documentElement.style.setProperty('--bs-light', this.colors.light);
        document.documentElement.style.setProperty('--bs-dark', this.colors.dark);

        // Apply layout options
        if (this.layout.header.fixed) {
            document.body.classList.add('header-fixed');
        }
        if (this.layout.header.inverse) {
            document.body.classList.add('header-inverse');
        }
        if (this.layout.sidebar.fixed) {
            document.body.classList.add('sidebar-fixed');
        }
        if (this.layout.sidebar.collapsed) {
            document.body.classList.add('sidebar-collapsed');
        }
        if (this.layout.sidebar.inverse) {
            document.body.classList.add('sidebar-inverse');
        }
        if (this.layout.content.boxed) {
            document.body.classList.add('content-boxed');
        }
    }
};

// Initialize theme
document.addEventListener('DOMContentLoaded', function () {
    themeConfig.apply();
}); 