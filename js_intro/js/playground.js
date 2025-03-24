/* Demonstration playground for Tutorial 4 */

console.log("playground.js is running");


/* Activity 2: Football Trophy */

// Activity 2, Rule 1

function average(values) {
    let sum = 0;
    for (let value of values) {
        sum += value;
    }
    return sum / values.length;
}

function determineRule1Winner() {
    const maskedOwlsScores = [72, 63, 99, 105];
    const quollsScores = [44, 89, 92, 111];

    const maskedOwlsAvg = average(maskedOwlsScores);
    const quollsAvg = average(quollsScores);

    let result = "";
    if (maskedOwlsAvg > quollsAvg) {
        result = "Masked Owls win the trophy!";
    } else if (maskedOwlsAvg < quollsAvg) {
        result = "Quolls win the trophy!";
    } else {
        result = "Its a draw! Both teams share the trophy";
    }

    document.getElementById("activity2-highest-avg").innerHTML = result;
}

// Activity 2, Rule 2

function wins(scores1, scores2) {
    let winCount = 0;

    for (let i in scores1) {
        if (scores1[i] > scores2[i]) {
            winCount++;
        }
    }

    return winCount;
}

function determineRule2Winner() {
    const maskedOwlsScores = [86, 45, 54, 73, 124];
    const quollsScores = [78, 61, 56, 77, 101];

    const maskedOwlsWins = wins(maskedOwlsScores, quollsScores);
    const quollsWins = wins(quollsScores, maskedOwlsScores);

    let result = "";
    if (maskedOwlsWins > quollsWins) {
        result = "Masked Owls win the trophy!";
    } else if (maskedOwlsWins < quollsWins) {
        result = "Quolls win the trophy!";
    } else {
        result = "Its a draw! Both teams share the trophy";
    }

    document.getElementById("activity2-most-wins").innerHTML = result;
}

//TODO Call the top-level functions determineRule1Winner and determinRule2Winner when they're ready


/* Activity 3: Tax */
let clients = { 
    Max: 24601,
    Ash: 55100,
    Bailey: 147800
};

function calculateTax(income) {
    let taxRate = 0.0;

    if (income > 130000) {
        taxRate = 0.27;
    } else if (income > 90000) {
        taxRate = 0.21;
    } else if (income > 45000) {
        taxRate = 0.15;
    } else {
        taxRate = 0.10;
    }

    return income * taxRate;
}

function processClientList() {
    let output = "";

    for (let name in clients) {
        let income = clients[name];
        let tax = calculateTax(income);
        let incomeAfterTax = income - tax;
        let message = `${name}'s income of $${income.toFixed(2)}, they pay $${tax.toFixed(2)} in tax, so their after tax income is $${incomeAfterTax.toFixed(2)}.`;
        output += message + "<br>";
    }

    document.getElementById("activity3-taxes").innerHTML = output;
}

/* Activity 4: Arbitrary HTML */

//TODO Write your function for Activity 4 here



// And call that function here

window.onload = function() {
    determineRule1Winner();
    determineRule2Winner();
    processClientList();
    // Call the function for Activity 4 here
}
