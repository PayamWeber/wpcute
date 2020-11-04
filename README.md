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
```php
Routes::get( 'path-to-page/{id}', 'MyController@action' );
Routes::post( 'path-to-page/{id}/extra/{name}', 'MyController@action' );
Routes::get( 'path-to-page/{id}/extra/{name}', function(){
    return "Hello World :)";
} );
```

#### ORM system
In this system you can build your database queries without writing any raw queries 
- Open folder "`/inc/base/Model/`" and start adding your models
```php
<?php
namespace MyCustomNamespace\MySubNamespace;

use PMW\Inc\Vendor\Model;

class Card extends Model
{
    protected $table = 'cards';
}
```
```php
use MyCustomNamespace\MySubNamespace\Card;

$cards = Card::select([ 'id', 'name' ])->where('points', '>', 10)->get();
$cards = Card::where('points', '>', 10)
    ->whereIn( 'count', [ 10, 20, 30 ] )
    ->leftJoin( 'products', 'cards.product_id', '=', 'products.id' )
    ->leftJoin( 'products', 'cards.product_id', '=', 'products.id' )
    ->orderby( [ 'id', 'name' ], 'DESC' )
    ->groupby( [ 'count' ] )
    ->get();
```