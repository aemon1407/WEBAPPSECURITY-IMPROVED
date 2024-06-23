// Event listener for form submission
const form = document.getElementById('form');
form.addEventListener('submit', async e => {
    e.preventDefault();
    if (await validateInputs()) {
        const formData = {
            name: document.getElementById('username').value,
            email: document.getElementById('email').value,
            matricno: document.getElementById('matricno').value,
            password: document.getElementById('password').value,
            bureau: document.getElementById('bureau').value 
        };

        try {
            const response = await fetch('Registration.php?action=store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();
            if (response.ok) {
                alert('Congrats, you are now a PEMBINA member');
                document.getElementById('form').reset();
            } else {
                alert('Failed to register member');
            }
        } catch (error) {
            console.error('An error occurred:', error);
            alert('Failed to register member');
        }
    }
});

async function validateInputs() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const matricno = document.getElementById('matricno').value;
    const password = document.getElementById('password').value;
    const password2 = document.getElementById('password2').value;

    const usernameRegex = /^[a-zA-Z\s]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const matricnoRegex = /^\d+$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!usernameRegex.test(username)) {
        alert('Name must contain only letters and spaces.');
        return false;
    }

    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (!await checkEmailUnique(email)) {
        alert('Email has already been used.');
        return false;
    }

    if (!matricnoRegex.test(matricno)) {
        alert('Matric number must contain only numbers.');
        return false;
    }

    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long and include at least one uppercase letter, one number, and one special character.');
        return false;
    }

    if (password !== password2) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}

async function checkEmailUnique(email) {
    try {
        const response = await fetch(`Registration.php?action=check_email&email=${encodeURIComponent(email)}`);
        const data = await response.json();
        return data.isUnique;
    } catch (error) {
        console.error('An error occurred:', error);
        return false;
    }
}

// Event listener for search form submission
const form1 = document.getElementById('form1');
form1.addEventListener('submit', async e => {
    e.preventDefault();
    const searchData = document.getElementById('searching').value.trim().toLowerCase();

    try {
        const response = await fetch(`Registration.php?action=search&search=${searchData}`);
        const data = await response.json();

        if (response.ok) {
            if (data.length > 0) {
                displayMemberTable(data);
            } else {
                alert('Data not found');
            }
        } else {
            throw new Error('Failed to fetch members');
        }
    } catch (error) {
        console.error('An error occurred:', error);
        alert('Failed to fetch members');
    }
});

function displayMemberTable(data) {
    const table = document.getElementById("memberlist");
    while (table.firstChild) {
        table.removeChild(table.firstChild);
    }

    const headerRow = document.createElement("tr");
    ['ID', 'Name', 'Matric No', 'Bureau'].forEach(headerText => {
        const headerCell = document.createElement("th");
        headerCell.textContent = headerText;
        headerRow.appendChild(headerCell);
    });
    table.appendChild(headerRow);

    data.forEach(member => {
        const row = document.createElement("tr");
        ['id', 'name', 'matricno', 'bureau'].forEach(key => {
            const cell = document.createElement("td");
            cell.textContent = member[key];
            row.appendChild(cell);
        });
        table.appendChild(row);
    });
}
