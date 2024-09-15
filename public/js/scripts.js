const linguisticMapping = {
    1: ["1", "1", "1"],
    2: ["1", "2", "3"],
    3: ["2", "3", "4"],
    4: ["3", "4", "5"],
    5: ["4", "5", "6"],
    6: ["5", "6", "7"],
    7: ["6", "7", "8"],
    8: ["7", "8", "9"],
    9: ["9", "9", "9"],
    0.5: ["0.33333", "0.5", "1"],
    0.33333: ["0.25", "0.3333", "0.5"],
    0.3333: ["0.25", "0.3333", "0.5"],
    0.25: ["0.2", "0.25", "0.33333"],
    0.2: ["0.1667", "0.2", "0.25"],
    0.1667: ["0.1429", "0.1667", "0.2"],
    0.166667: ["0.1429", "0.1667", "0.2"],
    0.1429: ["0.125", "0.1429", "0.1667"],
    0.125: ["0.1111", "0.125", "0.1429"],
    0.1111: ["0.1111", "0.1111", "0.1111"],
    0.111111: ["0.1111", "0.1111", "0.1111"]
};

function isValidValue(value) {
    const validValues = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0.5, 0.33333, 0.3333, 0.25, 0.2, 0.1667, 0.166667, 0.1429, 0.125, 0.1111, 0.111111];
    return validValues.includes(value);
}

function updateReciprocalMatrix() {
    for (let i = 0; i < 6; i++) {
        for (let j = 0; j < 6; j++) {
            if (i !== j) {
                let cell = document.getElementById(`cell-${i}-${j}`);
                let value = parseFloat(cell.value);
                let reciprocalCell = document.getElementById(`cell-${j}-${i}`);
                if (isNaN(value) || !isValidValue(value)) {
                    cell.value = "";
                    reciprocalCell.value = "";
                    reciprocalCell.disabled = false;
                } else {
                    reciprocalCell.value = (1 / value).toFixed(4);
                    reciprocalCell.disabled = true;
                }
            }
        }
    }
    updateSum();
    updateLinguisticVariables();
}

function updateSpecificReciprocals() {
    for (let i = 1; i < 6; i++) {
        let cell = document.getElementById(`cell-${i}-0`);
        let reciprocalCell = document.getElementById(`cell-0-${i}`);
        if (cell.value) {
            reciprocalCell.value = (1 / parseFloat(cell.value)).toFixed(4);
            reciprocalCell.disabled = true;
        }
    }

    for (let i = 2; i < 6; i++) {
        let cell = document.getElementById(`cell-${i}-1`);
        let reciprocalCell = document.getElementById(`cell-1-${i}`);
        if (cell.value) {
            reciprocalCell.value = (1 / parseFloat(cell.value)).toFixed(4);
            reciprocalCell.disabled = true;
        }
    }

    for (let i = 3; i < 6; i++) {
        let cell = document.getElementById(`cell-${i}-2`);
        let reciprocalCell = document.getElementById(`cell-2-${i}`);
        if (cell.value) {
            reciprocalCell.value = (1 / parseFloat(cell.value)).toFixed(4);
            reciprocalCell.disabled = true;
        }
    }

    for (let i = 4; i < 6; i++) {
        let cell = document.getElementById(`cell-${i}-3`);
        let reciprocalCell = document.getElementById(`cell-3-${i}`);
        if (cell.value) {
            reciprocalCell.value = (1 / parseFloat(cell.value)).toFixed(4);
            reciprocalCell.disabled = true;
        }
    }

    for (let i = 5; i < 6; i++) {
        let cell = document.getElementById(`cell-${i}-4`);
        let reciprocalCell = document.getElementById(`cell-4-${i}`);
        if (cell.value) {
            reciprocalCell.value = (1 / parseFloat(cell.value)).toFixed(4);
            reciprocalCell.disabled = true;
        }
    }

    updateSum();
    updateLinguisticVariables();
}

function updateSum() {
    for (let j = 0; j < 6; j++) {
        let sum = 0;
        for (let i = 0; i < 6; i++) {
            let cell = document.getElementById(`cell-${i}-${j}`);
            if (cell.value) {
                sum += parseFloat(cell.value);
            }
        }
        document.getElementById(`sum-${j}`).textContent = sum.toFixed(2);
    }
}

function setupMatrix() {
    for (let i = 0; i < 6; i++) {
        for (let j = 0; j < 6; j++) {
            let cell = document.getElementById(`cell-${i}-${j}`);
            if (i === j) {
                cell.value = 1;
                cell.disabled = true;
            } else {
                cell.value = ""; // Set default value as blank
                cell.addEventListener("input", function() {
                    updateSpecificReciprocals();
                });
            }
        }
    }
    updateSum();
}

function resetMatrix() {
    for (let i = 0; i < 6; i++) {
        for (let j = 0; j < 6; j++) {
            let cell = document.getElementById(`cell-${i}-${j}`);
            if (i === j) {
                cell.value = 1;
                cell.disabled = true;
            } else {
                cell.value = "";
                cell.disabled = false;
            }
        }
    }
    updateSum();
    updateLinguisticVariables();
}

function editMatrix() {
    for (let i = 0; i < 6; i++) {
        for (let j = 0; j < 6; j++) {
            let cell = document.getElementById(`cell-${i}-${j}`);
            if (i !== j) {
                cell.disabled = false;
            }
        }
    }
}

function updateLinguisticVariables() {
    let linguisticBody = document.getElementById("linguistic-body");
    linguisticBody.innerHTML = "";
    for (let i = 0; i < 6; i++) {
        let row = document.createElement("tr");
        for (let j = 0; j < 6; j++) {
            let cell = document.getElementById(`cell-${i}-${j}`);
            let value = parseFloat(cell.value);
            let cellContent = (i === j) ? "1, 1, 1" : (isValidValue(value) ? linguisticMapping[value.toString()].join(", ") : "");
            let td = document.createElement("td");
            td.textContent = cellContent;
            row.appendChild(td);
        }
        linguisticBody.appendChild(row);
    }
}

document.getElementById('compute-ahp').addEventListener('click', function() {
    // Extract matrix values and convert to linguistic variables
    const matrix = [
        [0, 1, 2, 3, 4, 5].map(col => parseFloat(document.getElementById(`cell-0-${col}`).value) || 1),
        [0, 1, 2, 3, 4, 5].map(col => parseFloat(document.getElementById(`cell-1-${col}`).value) || 1),
        [0, 1, 2, 3, 4, 5].map(col => parseFloat(document.getElementById(`cell-2-${col}`).value) || 1),
        [0, 1, 2, 3, 4, 5].map(col => parseFloat(document.getElementById(`cell-3-${col}`).value) || 1),
        [0, 1, 2, 3, 4, 5].map(col => parseFloat(document.getElementById(`cell-4-${col}`).value) || 1),
        [0, 1, 2, 3, 4, 5].map(col => parseFloat(document.getElementById(`cell-5-${col}`).value) || 1)
    ];

    const sums = matrix.map(row => row.reduce((acc, val) => acc + val, 0));

    // Compute the Fuzzy Geometric Mean for each row
    const fuzzyGeometricMeans = matrix.map(row => {
        const lowerProduct = row.reduce((acc, val) => acc * parseFloat(linguisticMapping[val.toString()]?.[0] || 1), 1);
        const middleProduct = row.reduce((acc, val) => acc * parseFloat(linguisticMapping[val.toString()]?.[1] || 1), 1);
        const upperProduct = row.reduce((acc, val) => acc * parseFloat(linguisticMapping[val.toString()]?.[2] || 1), 1);
        const n = row.length;
        return [
            Math.pow(lowerProduct, 1 / n).toFixed(3),
            Math.pow(middleProduct, 1 / n).toFixed(3),
            Math.pow(upperProduct, 1 / n).toFixed(3)
        ];
    });

    // Calculate the Fuzzy Weight Criteria by summing the lower, middle, and upper values
    const fuzzyWeightCriteria = fuzzyGeometricMeans.reduce((acc, val) => {
        acc[0] += parseFloat(val[0]);
        acc[1] += parseFloat(val[1]);
        acc[2] += parseFloat(val[2]);
        return acc;
    }, [0, 0, 0]).map(val => val.toFixed(3));

    // Calculate the Defuzzification
    const defuzzifications = fuzzyGeometricMeans.map(val => [
        (val[0] / fuzzyWeightCriteria[2]).toFixed(3),
        (val[1] / fuzzyWeightCriteria[1]).toFixed(3),
        (val[2] / fuzzyWeightCriteria[0]).toFixed(3)
    ]);

    // Calculate the center of area
    const centerOfAreas = defuzzifications.map(defuzz => (
        (parseFloat(defuzz[0]) + parseFloat(defuzz[1]) + parseFloat(defuzz[2])) / 3).toFixed(3));
    const sumCenterOfArea = centerOfAreas.reduce((acc, val) => acc + parseFloat(val), 0).toFixed(3);

    // Calculate the normalized values
    const normalizedValues = centerOfAreas.map(val => (parseFloat(val) / sumCenterOfArea).toFixed(3));

    // Display results
    const resultOutput = document.getElementById('result-output');
    resultOutput.innerHTML = '';
    const criteria = ['Confidentiality', 'Integrity', 'Availability', 'Authentication', 'Authorization', 'Non-Repudiation'];
    criteria.forEach((criterion, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${criterion}</td>
            <td>${sums[index].toFixed(2)}</td>
            <td>${matrix[index].map(val => `(${linguisticMapping[val.toString()]?.join(', ')})`).join(', ')}</td>
            <td>(${fuzzyGeometricMeans[index].join(', ')})</td>
            <td>(${fuzzyWeightCriteria.join(', ')})</td>
            <td>(${defuzzifications[index].join(', ')})</td>
            <td>${centerOfAreas[index]}</td>
            <td>${normalizedValues[index]}</td>
        `;
        resultOutput.appendChild(row);
    });

    document.getElementById('sum-center').textContent = sumCenterOfArea;
    document.getElementById('sum-normalized').textContent = '1.0';  // Ensure sum of normalized values is always 1
    document.getElementById('result').style.display = 'block';
    updateLinguisticVariables();
});

document.getElementById('reset-button').addEventListener('click', function() {
    resetMatrix();
    document.getElementById('result').style.display = 'none';
    document.querySelectorAll('td[id^="sum-"]').forEach(td => td.textContent = '0.00');
    document.getElementById('sum-normalized').textContent = '0.0';
    document.getElementById('sum-center').textContent = '0.0';
});

window.onload = function() {
    setupMatrix();
};
