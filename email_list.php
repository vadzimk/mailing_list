<?php include './view/header.php'; ?>
    <main>
        <h1>Email List</h1>
        <h2 class="last_paragraph"><?php echo htmlspecialchars($display_block); ?></h2>
        <br/>
        <section>
            <!-- display a table of emails -->
            <table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Suspended</th>
                    <th>Suspend</th>
                    <th>Unsubscribe</th>
                </tr>
                <?php foreach ($email_list as $row) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php if ($row['suspended'] == 1) echo "TRUE"; else echo "FALSE"; ?></td>
                        <td>
                            <form action="index.php" method="post">
                                <input type="hidden" name="admin" value="true">
                                <input type="hidden" name="action" value="suspend">
                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                <input type="submit" value="suspend">
                            </form>
                        </td>
                        <td>
                            <form action="index.php" method="post">
                                <input type="hidden" name="admin" value="true">
                                <input type="hidden" name="action" value="unsubscribe">
                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                <input type="submit" value="unsubscribe">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><a href=".?action=display_form">Add email</a></p>

        </section>
    </main>
<?php include './view/footer.php'; ?>