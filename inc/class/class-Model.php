<?php

namespace PMW\Inc\Vendor;

class Model
{
	/**
	 * this property shows models loaded or not
	 *
	 * @var bool
	 */
	protected static $models_loaded = false;

	/**
	 * this property defines the table name, its optional
	 *
	 * @var string
	 */
	protected $table = '';

	/**
	 * this property defines the post type name, its optional
	 *
	 * @var string
	 */
	protected $post_type = '';

	/**
	 * this is the post object
	 *
	 * @var object
	 */
	public $post_object;

	/**
	 * all of the post meta put here
	 *
	 * @var array
	 */
	public $post_all_meta = [];

	/**
	 * @var string
	 */
	public $query_where;

	/**
	 * @var string
	 */
	public $query_orderby;

	/**
	 * @var array
	 */
	public $query_join;

	/**
	 * @var string
	 */
	public $query_groupby;

	/**
	 * @var string
	 */
	public $query_select = '*';

	/**
	 * @var string
	 */
	public $query_table = '';

	/**
	 * @var bool
	 */
	public $is_group_where = false;

	/**
	 * @var bool
	 */
	public $is_count = false;

	/**
	 * this is allowed operators for where mysql
	 */
	const ALLOWED_OPERATORS = [ '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'NOT EXISTS', 'REGEXP', 'NOT REGEXP' ];

	/**
	 * Model constructor.
	 */
	public function __construct()
	{
		global $wpdb;
		$this->query_table = $this->table ? $wpdb->prefix . $this->table : $wpdb->posts;
	}

	/**
	 * generate post fields and meta automatically by only use it as a property
	 *
	 * @param $name
	 *
	 * @return array|object
	 */
	public function __get( $property )
	{
		if ( $this->post_object )
		{
			if ( $property == 'meta' )
			{
				return $this->generate_post_meta();
			}

			if ( isset( $this->post_object->$property ) )
			{
				return $this->post_object->$property;
			}
		}
	}

	/**
	 * set post fields and post meta by user
	 *
	 * @param $name
	 * @param $value
	 */
	public function __set( $name, $value )
	{
		if ( $this->post_object )
		{
			if ( $name == 'meta' )
			{
				$this->post_all_meta = $value;
			}

			if ( isset( $this->post_object->$name ) )
			{
				$this->post_object->$name = $value;
			}
		}
	}

	public function __call( $name, $arguments )
	{
		return $this->_call( $name, $arguments );
	}

	public static function __callStatic( $name, $arguments )
	{
		$self = new static();
		return $self->_call( $name, $arguments );
	}

	/**
	 * handle builtin methods as static or non static
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return $this|mixed|Model
	 */
	public function _call( $name, $arguments )
	{
		$arguments[ 'key' ]      = $arguments[ 'tb' ] = $arguments[ 'count' ] = $arguments[ 0 ] ?? '';
		$arguments[ 'operator' ] = $arguments[ 'field1' ] = $arguments[ 1 ] ?? '';
		$arguments[ 'value' ]    = $arguments[ 'join_operator' ] = $arguments[ 2 ] ?? '';
		$arguments[ 'field2' ]   = $arguments[ 3 ] ?? '';

		switch ( strtolower( $name ) )
		{
			case 'table':
				return $this->_table( $arguments[ 'tb' ] );
				break;
			case 'where':
				return $this->_where( $arguments[ 'key' ], $arguments[ 'operator' ], $arguments[ 'value' ] );
				break;
			case 'orwhere':
				return $this->_where( $arguments[ 'key' ], $arguments[ 'operator' ], $arguments[ 'value' ], 'OR' );
				break;
			case 'orderby':
				return $this->_orderby( $arguments[ 'key' ], $arguments[ 'operator' ] );
				break;
			case 'groupby':
				return $this->_groupby( $arguments[ 'key' ] );
				break;
			case 'select':
				return $this->_select( $arguments[ 'key' ] );
				break;
			case 'join':
				return $this->_join( $arguments[ 'tb' ], $arguments[ 'field1' ], $arguments[ 'join_operator' ], $arguments[ 'field2' ] );
				break;
			case 'outerjoin':
				return $this->_join( $arguments[ 'tb' ], $arguments[ 'field1' ], $arguments[ 'join_operator' ], $arguments[ 'field2' ], 'outer join' );
				break;
			case 'leftjoin':
				return $this->_join( $arguments[ 'tb' ], $arguments[ 'field1' ], $arguments[ 'join_operator' ], $arguments[ 'field2' ], 'left join' );
				break;
			case 'rightjoin':
				return $this->_join( $arguments[ 'tb' ], $arguments[ 'field1' ], $arguments[ 'join_operator' ], $arguments[ 'field2' ], 'right join' );
				break;
			case 'get':
				return $this->_get( $arguments[ 'count' ] );
				break;
			case 'first':
				return $this->_first();
				break;
			case 'count':
				return $this->_count();
				break;
			case 'tosql':
				return $this->_toSql( $arguments[ 'count' ] );
				break;
			case 'exists':
				$this->add_where_condition( 'EXISTS', "($arguments[key])", '' );
				return $this;
				break;
			case 'orexists':
				$this->add_where_condition( 'EXISTS', "($arguments[key])", '', 'OR' );
				return $this;
				break;
			case 'notexists':
				$this->add_where_condition( 'NOT EXISTS', "($arguments[key])", '' );
				return $this;
				break;
			case 'ornotexists':
				$this->add_where_condition( 'NOT EXISTS', "($arguments[key])", '', 'OR' );
				return $this;
				break;
			default:
				if ( $this->post_object && method_exists( $this->post_object, $name ) )
				{
					return call_user_func_array( [ $this->post_object, $name ], $arguments );
				}
				return $this;
				break;
		}

		return $this;
	}

	/**
	 * get models as array
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public static function query( array $args = [] )
	{
		$default_args = [
			'post_type' => ( new static )->post_type,
			'post_status' => 'publish',
			'posts_per_page' => 9999999,
		];
		$args         = array_merge( $default_args, $args );

		$posts = get_posts( $args );

		if ( $posts )
		{
			foreach ( $posts as $key => $post )
			{
				$posts[ $key ] = self::find( $post );
			}
		}

		return $posts;
	}

	/**
	 * @param $id
	 *
	 * @return Model|bool
	 */
	public static function find( $id = null )
	{
		if ( $id === false || $id === 0 || $id === '' )
			return false;

		if ( $id === null )
			global $post;

		$self              = new static();
		$self->post_object = $id ? ( is_object( $id ) ? $id : get_post( $id ) ) : ( $post ?? false );

		if ( ! $self->post_object )
			return false;

		if ( $self->post_object->post_type != $self->post_type )
			return false;

		if ( $self->post_type == 'product' && $self->post_object && function_exists( "wc_get_product" ) )
			$self->post_object = wc_get_product( $self->post_object );

		return $self;
	}

	/**
	 * @param string $dir
	 *
	 * @return bool|void
	 */
	public static function load_models( $dir = '' )
	{
		if ( ! self::$models_loaded )
		{
			$dir   = $dir ? $dir : NVM_DIR_PATH . '/inc/base/Model';
			$files = scandir( $dir );
			// remove dot member from array
			unset( $files[ array_search( '.', $files, TRUE ) ] );
			unset( $files[ array_search( '..', $files, TRUE ) ] );
			// prevent empty ordered elements
			if ( count( $files ) < 1 )
			{
				return;
			}
			foreach ( $files as $file )
			{
				if ( is_dir( $dir . '/' . $file ) )
				{
					self::load_models( $dir . '/' . $file );
				} else if ( substr( $file, -4, 4 ) == '.php' )
				{
					include( $dir . '/' . $file );
				}
			}
		}
		self::$models_loaded = true;

		return true;
	}

	/**
	 * @return array|object
	 */
	public function generate_post_meta()
	{
		if ( $this->post_all_meta )
		{
			return $this->post_all_meta;
		}
		if ( $this->post_object && ! $this->post_all_meta )
		{
			// get and sort all post meta
			$all_meta = get_post_custom( $this->post_type == 'product' ? $this->post_object->get_id() : $this->post_object->ID );
			if ( $all_meta )
			{
				foreach ( $all_meta as $meta => $value )
				{
					if ( $value && count( $value ) == 1 )
					{
						$all_meta[ $meta ] = $value[ 0 ];
					} else if ( ! $value )
					{
						$all_meta[ $meta ] = '';
					}
				}
			}
			$this->post_all_meta = (object) $all_meta;

			return $this->post_all_meta;
		}
		return [];
	}

	/**
	 * @param        $key
	 * @param string $operator_or_value
	 * @param string $value
	 * @param string $type
	 *
	 * @return $this
	 */
	private function _where( $key, $operator_or_value = '=', $value = '', $type = 'AND' )
	{
		$operator = in_array( $operator_or_value, self::ALLOWED_OPERATORS ) ? $operator_or_value : '=';
		$value    = in_array( $operator_or_value, self::ALLOWED_OPERATORS ) ? $value : $operator_or_value;

		if ( $key )
		{
			$colon = true;
			if ( mb_substr( $value, 0, 7 ) == '####raw' ){
				$value = mb_substr( $value, 7, strlen( $value ) );
				$colon = false;
			}

			$this->add_where_condition( $key, $value, $operator, $type, $colon );
		}

		return $this;
	}

	/**
	 * @param        $key
	 * @param        $value
	 * @param string $operator
	 * @param string $type
	 */
	private function add_where_condition( $key, $value, $operator = '=', $type = 'AND', $colon = true )
	{
		if ( ! $this->query_where )
			$type = '';
		else if ( trim( mb_substr( $this->query_where, strlen( $this->query_where ) - 5, 5 ) ) == '(' )
			$type = '';
		else
			$type = " $type ";

		// set group where conditions
		if ( is_callable( $key ) )
		{
			$this->query_where    .= "{$type} ( ";
			$this->is_group_where = true;
			$key( $this );
			$this->is_group_where = false;
			$this->query_where    .= " ) ";
		} else
		{
			if ( $this->is_group_where == false )
			{
				$this->query_where .= $type;
			} else
			{
				$this->is_group_where = false;
			}

			if ( ! in_array( $key, [ 'EXISTS', 'NOT EXISTS' ] ) && $colon === true ){
				$value = "'$value'";
			}

			$this->query_where .= "{$key} $operator $value";
		}
	}

	/**
	 * @param        $name
	 * @param string $order
	 *
	 * @return $this
	 */
	private function _orderby( $name, $order = 'ASC' )
	{
		$this->query_orderby = "ORDER BY $name $order";

		return $this;
	}

	/**
	 * @param $name
	 *
	 * @return $this
	 */
	private function _groupby( $name )
	{
		if ( ! $name )
			return $this;
		if ( is_string( $name ) )
			$this->query_groupby = "GROUP BY " . $name;
		if ( is_array( $name ) )
			$this->query_groupby = "GROUP BY " . implode( ', ', $name );

		return $this;
	}

	/**
	 * @param $name
	 *
	 * @return $this
	 */
	private function _select( $name )
	{
		if ( ! $name )
			$this->query_select = '*';
		if ( is_string( $name ) )
			$this->query_select = $name;
		if ( is_array( $name ) )
			$this->query_select = implode( ', ', $name );

		return $this;
	}

	/**
	 * @param        $db
	 * @param        $field1
	 * @param        $operator
	 * @param        $field2
	 * @param string $type
	 *
	 * @return $this
	 */
	private function _join( $db, $field1, $operator, $field2, $type = 'inner join' )
	{
		$this->query_join[] = "$type $db on $field1 $operator $field2";

		return $this;
	}

	/**
	 * @param $name
	 *
	 * @return $this
	 */
	private function _table( $name )
	{
		if ( $name )
			$this->query_table = $name;

		return $this;
	}

	/**
	 * @return bool|mixed
	 */
	private function _first()
	{
		$result = $this->_get( 1 );

		return $result ? $result[ 0 ] : false;
	}

	/**
	 * @param int $count
	 *
	 * @return array|object|null
	 */
	private function _get( $count = 0 )
	{
		global $wpdb;

		$query_string = $this->_toSql( $count );

		$posts = $wpdb->get_results( $query_string );

		if ( $this->is_count ){
			return (int)($posts[0]->count ?? 0);
		}

		if ( $posts && $this->post_type && ! $this->table )
		{
			foreach ( $posts as $key => $post )
			{
				$posts[ $key ] = self::find( $post );
			}
		}

		return $posts;
	}

	/**
	 * @return array|object|null
	 */
	private function _count()
	{
		$this->is_count = true;
		$this->query_select = 'COUNT(*) as count';
		return $this->_get();
	}

	/**
	 * @param int $count
	 *
	 * @return string
	 */
	private function _toSql( $count = 0 )
	{
		global $wpdb;
		$count            = $count ? "LIMIT $count" : '';
		$this->query_join = $this->query_join ? implode( ', ', $this->query_join ) : '';

		//initial where conditions
		if ( $this->post_type && ! $this->table )
		{
			$this->add_where_condition( 'post_type', $this->post_type );
			$this->query_select = $this->query_select == '*' ? $this->query_select : $this->query_select . ', ID';
		}

		$this->query_where = $this->query_where ? 'where ' . $this->query_where : '';

		$query_string = "select $this->query_select from `$this->query_table` $this->query_join $this->query_where $this->query_groupby $this->query_orderby $count";

		return $query_string;
	}

	/**
	 * @param $query
	 *
	 * @return string
	 */
	public static function raw( $query )
	{
		return '####raw' . $query;
	}
}

//Model::load_models();