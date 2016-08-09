<?php

if( !defined( 'MEDIAWIKI' ) ) {
    echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
    die( -1 );
}

/*
The MIT License (MIT)

Copyright (c) 2015 maelstr0m

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

$wgExtensionCredits['validextensionclass'][] = array(
    'path'           => __FILE__,
    'name'           => 'Imgur',
    'version'        => '1.0',
    'author'         => 'maelstr0m',
    'url'            => 'https://www.mediawiki.org/wiki/Extension:Imgur',
    'description'    => 'Allows Imgur uploaded images to be displayed on the wiki'
);

/*  Example CSS
 *
 *  .imgur-thumb {
 *      border: solid 1px #aaaaaa;
 *      background: #eeeeee;
 *      padding-left: 3px;
 *      padding-right: 3px;
 *      padding-top: 3px;
 *  }
 */

$wgHooks['ParserFirstCallInit'][] = 'wfImgurInit';

function wfImgurInit( Parser $parser ) {
    $parser->setHook( 'imgur', 'wfImgurRender' );
    return true;
}

function wfImgurRender( $input, array $args, Parser $parser, PPFrame $frame ) {
    if ( strtolower($args["thumb"]) == "yes")
    {
        return "<div class='imgur-thumb' style='float: right; clear: right;'><a href='https://i.imgur.com/".htmlspecialchars( $input )."'><img width='".htmlspecialchars( $args['w'] )."px' src='https://i.imgur.com/".htmlspecialchars( $input )."'<img></a><p style='line-height:100%;width:".htmlspecialchars( $args['w'] )."px'>".htmlspecialchars( $args["comment"] )."</p></div>";
    }
    else
    {
        return "<a href='https://i.imgur.com/".htmlspecialchars( $input )."'><img width='".htmlspecialchars( $args['w'] )."px' src='https://i.imgur.com/".htmlspecialchars( $input )."'<img></a>";
    }
}
