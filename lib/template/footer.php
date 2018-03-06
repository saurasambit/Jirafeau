
<div id="copyright">
    <p>
        <!-- Project links -->
        <?php
          echo t('MADE_WITH') .
            ' <a href="https://gitlab.com/mojo42/Jirafeau">' . t('JI_PROJECT') . '</a>' .
            ' (<a href="https://www.gnu.org/licenses/agpl.html"><abbr title="GNU Affero General Public License v3">AGPL-3.0</abbr></a>)';
        ?>
        <!-- Installation dependend links -->
        <?php
        if (false === empty($cfg['installation_done'])) {
            echo ' <span>|</span> ';
            echo '<a href="tos.php">' . t('TOS') . '</a>';
        }
        ?>
    </p>
</div>
</div>
<div id="jyraphe">
</div>
</body>
</html>
