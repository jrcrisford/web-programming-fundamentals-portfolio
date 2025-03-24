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
window.onload = function() {
    determineRule1Winner();
    determineRule2Winner();
};

/* Activity 3: Tax */


let clients = { //TODO Record client incomes here

};

//TODO Write your other functions for Activity 3 here



/* Activity 4: Arbitrary HTML */

//TODO Write your function for Activity 4 here



// And call that function here


