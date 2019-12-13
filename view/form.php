<?php include "header.php"; ?>
<form action="index.php" method="post">



    <label>
        Your email address:
    </label>
    <br/>
    <input type="email" name="email" size="40" maxlength="150"/>
    <fieldset>
        <legend>
            Action:
        </legend>
        <input type="radio" name="action" value="subscribe" checked id="action_sub"/>
        <label for="action_sub">subscribe</label>
        <br/>
        <input type="radio" name="action" value="unsubscribe" id="action_unsub"/>
        <label for="action_unsub">unsubscribe</label>
        <br/>
        <input type="radio" name="action" value="suspend" id="action_susp"/>
        <label for="action_susp">suspend</label>
    </fieldset>
    <input type="submit" value="Submit"/>
</form>
<br/>
<h2 class="last_paragraph"><?php echo htmlspecialchars($display_block); ?></h2>
<p><a href="?action=display_list">Admin </a></p>

<?php include "footer.php"; ?>

