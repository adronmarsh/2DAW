<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas</title>
</head>
<body>
    <table>
        <tr>
            <td>X</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
        </tr>
    <?php
        for ($i=1; $i <= 10; $i++) { 
            ?>
                <td><?=$i?></td>
            <?php
            for ($j=1; $j <= 10; $j++) { 
                ?>
                <td><?=$i*$j?></td>
                <?php
            }
            ?>
            
            </tr>
            <?php
        }
    ?>
    </table>
</body>
</html>