<?php
/*
Plugin Name: Future Perfect
Plugin URI: https://underscorefunk.com/plugins/future-perfect
Description: A WordPress plugin that makes sure future dated posts are actually published.
Version: 0.1.0
Requires at least: 5.8
Requires PHP: 7.4
Author: Underscorefunk Design <john@underscorefunk.com>
Author URI: https://underscorefunk.com
License: GPL-3.0+
Domain Path: /languages

------------------------------------------------------------------------
Copyright 2022 Underscorefunk Design

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.

------------------------------------------------------------------------
*/
namespace underscorefunk\future_perfect;

include( __DIR__ . '/vendor/autoload.php' );

Plugin::init( __FILE__ );