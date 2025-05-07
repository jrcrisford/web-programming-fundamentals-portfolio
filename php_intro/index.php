<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="replace_with_your_name">
    <title>KIT202 Tutorial: Introducing PHP</title>
    <link rel="stylesheet" href="styles/demo_page.css">
  </head>
  <body>
    <?php
    // Activity 2 helper functions
    // (Can be placed anywhere before first use but if any debug output is produced
    // then it's better for them to be defined inside the body element)

    function average($values) {
      $sum = 0;
      foreach ($values as $score) {
        $sum += $score;
      }
      return $sum / count($values);
    }

    function wins($scores1, $scores2) {
      $winCount = 0;
      foreach ($scores1 as $i => $score1) {
        if ($score1 > $scores2[$i]) {
          $winCount++;
        }
      }
      return $winCount;
    }
    ?>

    <h1>KIT202 Tutorial: Introducing PHP</h1>
    <p>Edit this file by adding PHP code where needed to produce answers in the boxes below:</p>
    <section>
      <h2>Masked Owls v Bandicoots</h2>
      <ul>
        <li>
          Who won last year (highest average rule):
          <div class="answer">
            <?php
            $maskedOwls = [44, 111, 92, 89];
            $bandicoots = [72, 105, 99, 63];
      
            $maskedOwlsAvg = average($maskedOwls);
            $bandicootsAvg = average($bandicoots);
      
            if ($maskedOwlsAvg > $bandicootsAvg) {
              $result = "<strong>Masked Owls</strong> win the trophy!";
            } elseif ($bandicootsAvg > $maskedOwlsAvg) {
              $result = "<strong>Bandicoots</strong> win the trophy!";
            } else {
              $result = "<strong>It's a draw!</strong> Masked Owls and Bandicoots share the trophy.";
            }
      
            echo $result;
            ?>
          </div>
        </li>
        <li>
          Who won this year (most wins rule):
          <div class="answer">
            <?php
            $maskedOwlsNew = [78, 61,56, 73, 101];
            $bandicootsNew = [86, 45, 54, 73, 124];

            $maskedOwlsWins = wins($maskedOwls, $bandicoots);
            $bandicootsWins = wins($bandicoots, $maskedOwls);

            if ($maskedOwlsWins > $bandicootsWins) {
              $result = "<strong>MaskedOwls</Strong> win the trophy!";
            } elseif ($bandicootsWins > $maskedOwlsWins) {
              $result = "<strong>Banicoots</strong> win the trophy!";
            } else {
              $result = "It's a draw! <strong>Masked Owls</strong> and <strong>Bandicoots</strong> share the trophy.";
            }

            echo $result
            ?>
          </div>
        </li>
      </ul>
    </section>

    <?php
    // Activity 3 data and helper function
    // Note: large amounts of data would not normally be hard-coded in the page

    //TODO Record client incomes in this associative array
    $clients = [
      "Max" => 24601,
      "Ash" => 55100,
      "Bailey" => 147800
    ];

    function calculate_tax($income) {
      if ($income > 130000) {
        return $income * 0.27;
      } elseif ($income > 90000) {
        return $income * 0.21;
      } elseif ($income > 45000) {
        return $income * 0.15;
      } else {
        return $income * 0.10;
      }
    }
    ?>

    <section>
      <h2>Tax Calculator</h2>
      <ul>
        <li>
          Tax assessments:
          <div class="answer">
          <?php
          foreach ($clients as $name => $income) {
            $tax = calculate_tax($income);
            $net = $income - $tax;

            echo "<p>Given $name's taxable income of $" . $income .
            ", they pay $" . $tax . 
            " in tax, so their after tax income is $" . $net . ".</p>";
          }
          ?>
        </div>
        </li>
      </ul>
    </section>
  </body>
</html>
