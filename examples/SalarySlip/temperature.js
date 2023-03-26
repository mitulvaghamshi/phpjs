const fahrenheit = prompt("Please enter a temperature in Fahrenheit: ");

const num = parseFloat(fahrenheit);

if (isNaN(num)) {
    alert("Please enter a valid number, try again!");
    window.location.reload();
}

const temp = ((num - 32) * 5 / 9).toFixed(2);

let message = temp;

if (temp >= 0 && temp <= 10) {
    message = `Its a Winter (${temp})`;
} else if (temp > 10 && temp <= 21) {
    message = `Its a Spring (${temp})`;
} else if (temp > 21) {
    message = `Its a Summer (${temp})`;
}

const child = document.createElement("h1");
child.innerText = message;

document.getElementById("root").appendChild(child);
