## Login Limit Plugin

**Version:** 1.0  
**Author:** Sanket Thakkar  
**License:** GPLv2 or later  
**Tags:** security, login, limit attempts, brute force protection

---

### Description

The **Login Limit** plugin provides a simple and effective way to protect your WordPress website from brute force login attacks. By limiting the number of login attempts, it prevents attackers from guessing user credentials.

### Features

- Limits the number of failed login attempts (default: 3).
- Temporarily locks out users after 3 failed login attempts.
- Customizable lockout duration (default: 5 minutes).
- Displays a friendly message showing the time remaining before the next login attempt can be made.
- Cleans up transients when the plugin is uninstalled.

---

### Installation

1. Download the plugin and upload it to your `/wp-content/plugins/` directory, or install it through the WordPress plugins directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

---

### How It Works

1. **Failed Login Tracking:**
   - The plugin uses WordPress transients to track the number of failed login attempts.
   - If a user exceeds the allowed number of login attempts (default: 3), they are temporarily locked out for 5 minutes.

2. **Error Message:**
   - When users reach the login attempt limit, they will see a custom error message informing them of how long they must wait before trying again.

3. **Cleanup on Uninstall:**
   - When the plugin is uninstalled, the transient that stores the login attempt data is removed, ensuring your site stays clean and optimized.

---

### Hooks & Filters

The plugin uses the following hooks and filters:

- `authenticate` filter to check login attempts and block users if they exceed the limit.
- `wp_login_failed` action to increment the failed login count on unsuccessful login attempts.

---

### Uninstallation

When uninstalled, the plugin performs the following cleanup tasks:

- Removes the transient `attempted_login` used to store login attempts.
- (Optional) Removes any custom options or settings stored in the WordPress database.

---

### Code Standards

The plugin follows WordPress Coding Standards:

- Functions are prefixed to avoid name conflicts.
- Proper escaping is used to prevent security vulnerabilities.
- The plugin is translation-ready with a text domain for localization.

---

### Contributing

If you find a bug or have an idea for improving the plugin, feel free to submit a pull request or open an issue on the plugin's GitHub repository.

---

### License

This plugin is licensed under the GPLv2 or later. You are free to modify and distribute it under the same terms.

---

### Contact

For support or inquiries, contact on Github Repo 

---

### Example Usage

After installation and activation, users will automatically benefit from the security features of the plugin. You don't need to configure anything out of the box.

