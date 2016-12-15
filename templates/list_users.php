<section class = "central">
    <div class="container">
        <?php foreach($users as $userprofile) {
            if ($userprofile['status']!='admin'){?>
            <article class="userprofile box">
                <table>
                    <tr>
                        <td class="td-image img-col" rowspan="5"><img src="../uploads/users/<?= $userprofile['photopath'] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3" id="td-user"><h2><?= $userprofile['name'] ?></h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="td-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                        <td class="td-info"><?= $userprofile['city'] ?>&nbsp;&middot&nbsp;<?= $userprofile['country'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="td-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></td>
                        <td class="td-info"><?= $userprofile['birthday'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="td-icon"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                        <td class="td-info"><?= $userprofile['email'] ?></td>
                    </tr>
                </table>
            </article>
        <?php } } ?>
    </div>
</section>