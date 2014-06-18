<?php
/**
 * This work is licenced under the Creative Commons
 * Attribution-Non-Commercial-Share Alike 2.0 UK: England & Wales License. To
 * view a copy of this licence, visit
 * http://creativecommons.org/licenses/by-nc-sa/2.0/uk/ or send a letter to
 * Creative Commons, 171 Second Street, Suite 300, San Francisco,
 * California 94105, USA.
 *
 * @copyright Steve "Uru" West 2010
 * @author Steve "Uru" West
 * @version 2010-01-08
 *
 * This file defines how the buttons on the right hand side should be laid out.
 * It can contain anything as long as it is valid HTML.
 * The javascript function, insertAtCursor() can be used to insert text into
 * the input window.
 *                                                        \/textarea to use \/ \/- The value to enter
 * Eg: <img src="some_image.png" onClick="insertAtCursor( document.main.input, 'some value')" />
 */
?>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="small" colspan="10">Control</td>
    </tr>
    <tr>
        <td width="20" height="20"><img title="IF" alt="IF" src="img/if.gif" onClick="insertAtCursor(document.main.input,'IF ')" /></td>
        <td width="20" height="20"><img title="ENDIF" alt="ENDIF" src="img/endif.gif" onClick="insertAtCursor(document.main.input,'ENDIF ')" /></td>
        <td width="20" height="20"><img title="ELSE" alt="ELSE" src="img/else.gif" onClick="insertAtCursor(document.main.input,'ELSE ')" /></td>
        <td width="20" height="20"><img title="ELSEIF" alt="ELSEIF" src="img/elseif.gif" onClick="insertAtCursor(document.main.input,'ELSEIF ')" /></td>
        <td width="20" height="20"><img title="WHILE" alt="WHILE" src="img/while.gif" onClick="insertAtCursor(document.main.input,'WHILE ')" /></td>
        <td width="20" height="20"><img title="BLOCK" alt="BLOCK" src="img/block.gif" onClick="insertAtCursor(document.main.input,'BLOCK ')" /></td>
        <td width="20" height="20"><img title="ENDBLOCK" alt="ENDBLOCK" src="img/blockend.gif" onClick="insertAtCursor(document.main.input,'ENDBLOCK ')" /></td>
        <td width="20" height="20"><img title="TAKES" alt="TAKES" src="img/takes.gif" onClick="insertAtCursor(document.main.input,'TAKES ')" /></td>
        <td width="20" height="20"><img title="RETURN" alt="RETURN" src="img/return.gif" onClick="insertAtCursor(document.main.input,'RETURN ')" /></td>
    </tr>

    <tr>
        <td class="small" colspan="10">Logic</td>
    </tr>
    <tr>
        <td width="20" height="20"><img title="OR" alt="OR" src="img/or.gif" onClick="insertAtCursor(document.main.input,'OR ')" /></td>
        <td width="20" height="20"><img title="AND" alt="AND" src="img/and.gif" onClick="insertAtCursor(document.main.input,'AND ')" /></td>
        <td width="20" height="20"><img title="SAMEAS" alt="SAMEAS" src="img/sameas.gif" onClick="insertAtCursor(document.main.input,'SAMEAS ')" /></td>
        <td width="20" height="20"><img title="NOTSAMEAS" alt="NOTSAMEAS" src="img/notsameas.gif" onClick="insertAtCursor(document.main.input,'NOTSAMEAS ')" /></td>
        <td width="20" height="20"><img title="SMALLERTHAN" alt="SMALLERTHAN" src="img/smallerthan.gif" onClick="insertAtCursor(document.main.input,'SMALLERTHAN ')" /></td>
        <td width="20" height="20"><img title="BIGGERTHAN" alt="BIGGERTHAN" src="img/biggerthan.gif" onClick="insertAtCursor(document.main.input,'BIGGERTHAN ')" /></td>
        <td width="20" height="20"><img title="TRUE" alt="TRUE" src="img/true.gif" onClick="insertAtCursor(document.main.input,'TRUE ')" /></td>
        <td width="20" height="20"><img title="FALSE" alt="FALSE" src="img/false.gif" onClick="insertAtCursor(document.main.input,'FALSE ')" /></td>
    </tr>

    <tr>
        <td class="small" colspan="10">Math</td>
    </tr>
    <tr>
        <td width="20" height="20"><img title="VAR" alt="VAR" src="img/var.gif" onClick="insertAtCursor(document.main.input,'VAR ')" /></td>
        <td width="20" height="20"><img title="INCREMENT" alt="INCREMENT" src="img/incre.gif" onClick="insertAtCursor(document.main.input,'INCREMENT ')" /></td>
        <td width="20" height="20"><img title="DECREMENT" alt="DECREMENT" src="img/decre.gif" onClick="insertAtCursor(document.main.input,'DECREMENT ')" /></td>
        <td width="20" height="20"><img title="ADD" alt="ADD" src="img/plus.gif" onClick="insertAtCursor(document.main.input,'ADD ')" /></td>
        <td width="20" height="20"><img title="SUB" alt="SUB" src="img/minus.gif" onClick="insertAtCursor(document.main.input,'SUB ')" /></td>
        <td width="20" height="20"><img title="MUL" alt="MUL" src="img/times.gif" onClick="insertAtCursor(document.main.input,'MUL ')" /></td>
        <td width="20" height="20"><img title="DEV" alt="DEV" src="img/devide.gif" onClick="insertAtCursor(document.main.input,'DEV ')" /></td>
    </tr>

    <tr>
        <td class="small" colspan="10">Misc</td>
    </tr>
    <tr>
        <td width="20" height="20"><img title="SAY" alt="SAY" src="img/say.gif" onClick="insertAtCursor(document.main.input,'SAY ')" /></td>
        <td width="20" height="20"><img title="COMMENT" alt="COMMENT" src="img/comment.gif" onClick="insertAtCursor(document.main.input,'COMMENT ')" /></td>
        <td width="20" height="20"><img title="ENDCOMMENT" alt="ENDCOMMENT" src="img/endcomment.gif" onClick="insertAtCursor(document.main.input,'ENDCOMMENT ')" /></td>
        <td width="20" height="20"><img title="NEWLINE" alt="NEWLINE" src="img/newline.gif" onClick="insertAtCursor(document.main.input,'NEWLINE ')" /></td>
        <td width="20" height="20"><img title="JOIN" alt="JOIN" src="img/join.gif" onClick="insertAtCursor(document.main.input,'JOIN ')" /></td>
        <td width="20" height="20"><img title=">>" alt=">>" src="img/str_start.gif" onClick="insertAtCursor(document.main.input,'>> ')" /></td>
        <td width="20" height="20"><img title="<<" alt="<<" src="img/str_end.gif" onClick="insertAtCursor(document.main.input,'<< ')" /></td>
    </tr>
</table>