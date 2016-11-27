<section class = "central">
    <div class="container">
        <?php
        $result = getAllRestaurants();

        foreach( $result as $row) {
            echo '<p>' . $row['name'] . '</p>';
            echo '<p>' . $row['idOwner'] . '</p>';
        }
        ?>
    </div>
</section>
