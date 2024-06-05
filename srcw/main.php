<?php

/* The `TemplateInfoAdminBar` class in PHP adds template information and theme folder structure to the
WordPress admin bar for users with manage options capability. */
class TemplateInfoAdminBar {
    private $_template;
    private $_wp_admin_bar;
    protected $_edit_allowed;

    /**
     * The constructor function sets up actions to add various information to the admin bar in
     * WordPress.
     */
    public function __construct() {
        add_action('admin_bar_menu', array($this, 'setup_globals'), 100);
        add_action('admin_bar_menu', array($this, 'add_template_info_to_admin_bar'), 101);
        add_action('admin_bar_menu', array($this, 'add_folder_structure_to_admin_bar'), 102);
    }

    /**
     * The function `is_file_editing_allowed` checks if file editing is allowed based on defined
     * constants in PHP.
     * 
     * @return The function `is_file_editing_allowed()` returns a boolean value indicating whether file
     * editing is allowed. It returns `true` if file editing is allowed and `false` if file editing is
     * disallowed based on the conditions specified in the function.
     */
    private function is_file_editing_allowed() {
        return ! ( ( defined( 'DISALLOW_FILE_EDIT' ) && true == DISALLOW_FILE_EDIT ) || ( defined( 'DISALLOW_FILE_MODS' ) && true == DISALLOW_FILE_MODS ) );
    }

    /**
     * The function `setup_globals` sets up global variables for ``, ``, and
     * `_edit_allowed` in PHP.
     */
    public function setup_globals() {
        global $wp_admin_bar;
        $this->_wp_admin_bar = $wp_admin_bar;
        global $template;
        $this->_template = $template ?? '';
        $this->_edit_allowed = $this->is_file_editing_allowed();
    }

   /**
    * The function `add_template_info_to_admin_bar` adds template information to the WordPress admin
    * bar for users with manage options capability.
    */
    public function add_template_info_to_admin_bar() {
        if (current_user_can('manage_options')) {
            
            $template_path = htmlspecialchars($this->_template);
            $template_name = basename($template_path);
            $theme_name = get_template();
            $this->_wp_admin_bar->add_menu(array(
                'id' => 'template_info',
                'title' => 'Template: '. $template_name,
                'href' =>  ( ( $this->_edit_allowed ) ? get_admin_url() . 'theme-editor.php?file=' . $template_name . '&theme=' . $theme_name : false ),
                'meta' => array(
                    'title' => 'Currently Used Template',
                ),
            ));
        }
    }

    /**
     * The function adds the theme folder structure to the admin bar for users with the capability to
     * manage options.
     */
    public function add_folder_structure_to_admin_bar() {
        if (current_user_can('manage_options')) {
            $theme_root = get_theme_root();
            $theme_name = get_template();
            $this->_wp_admin_bar->add_menu(array(
                'id' => 'folder_structure',
                'title' => 'Theme Folder: ' . $theme_name,
                'href' => $theme_root . '/' . $theme_name,
                'meta' => array(
                    'title' => 'Theme Folder',
                ),
            ));
        }
    }
}

