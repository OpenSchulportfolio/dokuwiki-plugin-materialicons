<?php
/**
 * DokuWiki Plugin materialicons (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Frank Schiebel <frank@linuxmuster.net>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_materialicons extends DokuWiki_Syntax_Plugin {
    /**
     * @return string Syntax mode type
     */
    public function getType() {
        return 'substition';
    }

    function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
    /**
     * @return string Paragraph type
     */
    public function getPType() {
        return 'normal';
    }
    /**
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort() {
        return 100;
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode) {
        $this->Lexer->addEntryPattern('<mdi',$mode,'plugin_materialicons');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('>','plugin_materialicons');
    }

    /**
     * Handle matches of the materialicons syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler $handler){
        return array($state,$match);
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        if($mode != 'xhtml') return false;

        list($state,$match)=$data;
        if ($state == DOKU_LEXER_UNMATCHED){
            $class = $match;
            $class = str_replace("large","dwmdi-large", $class);
            $class = str_replace("larger","dwmdi-larger", $class);
            $class = str_replace("huge","dwmdi-huge", $class);
            $renderer->doc .= '<i class="mdi '. $renderer->_xmlEntities($class) .'"></i>';
            return true;
        }

        return false;
    }
}

// vim:ts=4:sw=4:et:
