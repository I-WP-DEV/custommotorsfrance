<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'briny_storage_get' ) ) {
	function briny_storage_get( $var_name, $default = '' ) {
		global $BRINY_STORAGE;
		return isset( $BRINY_STORAGE[ $var_name ] ) ? $BRINY_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'briny_storage_set' ) ) {
	function briny_storage_set( $var_name, $value ) {
		global $BRINY_STORAGE;
		$BRINY_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'briny_storage_empty' ) ) {
	function briny_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $BRINY_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $BRINY_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $BRINY_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $BRINY_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'briny_storage_isset' ) ) {
	function briny_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $BRINY_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $BRINY_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $BRINY_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $BRINY_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'briny_storage_inc' ) ) {
	function briny_storage_inc( $var_name, $value = 1 ) {
		global $BRINY_STORAGE;
		if ( empty( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = 0;
		}
		$BRINY_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'briny_storage_concat' ) ) {
	function briny_storage_concat( $var_name, $value ) {
		global $BRINY_STORAGE;
		if ( empty( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = '';
		}
		$BRINY_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'briny_storage_get_array' ) ) {
	function briny_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $BRINY_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $BRINY_STORAGE[ $var_name ][ $key ] ) ? $BRINY_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $BRINY_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $BRINY_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'briny_storage_set_array' ) ) {
	function briny_storage_set_array( $var_name, $key, $value ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$BRINY_STORAGE[ $var_name ][] = $value;
		} else {
			$BRINY_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'briny_storage_set_array2' ) ) {
	function briny_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $BRINY_STORAGE[ $var_name ][ $key ] ) ) {
			$BRINY_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$BRINY_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$BRINY_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'briny_storage_merge_array' ) ) {
	function briny_storage_merge_array( $var_name, $key, $value ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$BRINY_STORAGE[ $var_name ] = array_merge( $BRINY_STORAGE[ $var_name ], $value );
		} else {
			$BRINY_STORAGE[ $var_name ][ $key ] = array_merge( $BRINY_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'briny_storage_set_array_after' ) ) {
	function briny_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			briny_array_insert_after( $BRINY_STORAGE[ $var_name ], $after, $key );
		} else {
			briny_array_insert_after( $BRINY_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'briny_storage_set_array_before' ) ) {
	function briny_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			briny_array_insert_before( $BRINY_STORAGE[ $var_name ], $before, $key );
		} else {
			briny_array_insert_before( $BRINY_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'briny_storage_push_array' ) ) {
	function briny_storage_push_array( $var_name, $key, $value ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $BRINY_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $BRINY_STORAGE[ $var_name ][ $key ] ) ) {
				$BRINY_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $BRINY_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'briny_storage_pop_array' ) ) {
	function briny_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $BRINY_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $BRINY_STORAGE[ $var_name ] ) && is_array( $BRINY_STORAGE[ $var_name ] ) && count( $BRINY_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $BRINY_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $BRINY_STORAGE[ $var_name ][ $key ] ) && is_array( $BRINY_STORAGE[ $var_name ][ $key ] ) && count( $BRINY_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $BRINY_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'briny_storage_inc_array' ) ) {
	function briny_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( empty( $BRINY_STORAGE[ $var_name ][ $key ] ) ) {
			$BRINY_STORAGE[ $var_name ][ $key ] = 0;
		}
		$BRINY_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'briny_storage_concat_array' ) ) {
	function briny_storage_concat_array( $var_name, $key, $value ) {
		global $BRINY_STORAGE;
		if ( ! isset( $BRINY_STORAGE[ $var_name ] ) ) {
			$BRINY_STORAGE[ $var_name ] = array();
		}
		if ( empty( $BRINY_STORAGE[ $var_name ][ $key ] ) ) {
			$BRINY_STORAGE[ $var_name ][ $key ] = '';
		}
		$BRINY_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'briny_storage_call_obj_method' ) ) {
	function briny_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $BRINY_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $BRINY_STORAGE[ $var_name ] ) ? $BRINY_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $BRINY_STORAGE[ $var_name ] ) ? $BRINY_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'briny_storage_get_obj_property' ) ) {
	function briny_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $BRINY_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $BRINY_STORAGE[ $var_name ]->$prop ) ? $BRINY_STORAGE[ $var_name ]->$prop : $default;
	}
}
