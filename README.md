# WPCute theme for wordpress
##### A Base Theme for those who want to speed their theme making proccess

## Main features
1. MVC Design pattern
   1. Perfect for Laravel users
   1. ORM System similar to Laravel Eloquent
   1. Routing system similar to Laravel
   1. Easy to use view system
   1. Namespace based Controllers and Models
1. Database query builder implemented directly inside model class
1. Built-in design for making Elementor widgets
1. Ready to use codes for adding post types
1. Custom captcha loader
1. Built-in design for adding ACF settings (Advanced Custom Fields Plugin)

*****************************************
## Examples

#### Routing system
You can add your custom routes to theme so fast.
- Open file "`/inc/base/routes.php`" and start adding your routes
```
Routes::get( 'path-to-page/{id}', 'MyController@action' );
Routes::post( 'path-to-page/{id}/extra/{name}', 'MyController@action' );
```