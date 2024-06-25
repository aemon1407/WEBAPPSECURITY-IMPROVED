$(document).ready(function() {
    // Get the modal elements
    var addModal = $('#addModal');
    var editModal = $('#editModal');

    // Get the <span> elements that close the modals
    var addClose = addModal.find('.close');
    var editClose = editModal.find('.close');

    // Open the add modal
    $('.add-btn').click(function() {
        addModal.show();
    });

    // Close the add modal
    addClose.click(function() {
        addModal.hide();
    });

    // Close the edit modal
    editClose.click(function() {
        editModal.hide();
    });

    // Close modals when clicking outside of them
    $(window).click(function(event) {
        if (event.target == addModal[0]) {
            addModal.hide();
        }
        if (event.target == editModal[0]) {
            editModal.hide();
        }
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // // Load members from database
    function loadMembers() {
        $.get('dashboard.php?action=get_members', function(data) {

            const members = data;

            let rows = '';
            members.forEach((member, index) => {
                rows += `<tr>
                    <td><input id="${member.id}" class="select-member" type="checkbox" value="${member.id}"></td>
                    <td>${index + 1}</td>
                    <td>${member.name}</td>
                    <td>${member.matricno}</td>
                    <td>${member.email}</td>
                    <td>${capitalizeFirstLetter(member.bureau)}</td>
                </tr>`;
            });
            $('tbody').html(rows);
        });
    }

    // loadMembers();

    // Handle add form submission
    $('#addForm').submit(function(event) {
        event.preventDefault();
        $.post('dashboard.php', {
            action: 'create',
            name: $('#addName').val(),
            matricno: $('#addMatricNo').val(),
            email: $('#addEmail').val(),
            bureau: $('#addBureau').val(),
            csrf: $('#csrf').val()
        }, function(data) {
            addModal.hide();
            loadMembers(data.message);
            renderBanner(data.message, data.status);
        })
    });

    // Open edit modal and fill in the form
    $('.edit-btn').click(function() {
        const selected = $('.select-member:checked');
        if (selected.length !== 1) {
            alert('Please select any member to edit.');
            return;
        }
        const id = selected.val();
        $.get('dashboard.php?action=get_members', function(members) {
            const member = members.find(m => m.id == id);
            $('#editId').val(member.id);
            $('#editName').val(member.name);
            $('#editMatricNo').val(member.matricno);
            $('#editEmail').val(member.email);
            $('#editBureau').val(member.bureau);
            editModal.show();
        });
    });

    function renderBanner(message, status = 'success') {

        console.log(status)

        $('.banner > #banner-description').text(message);

        if (status === 'success') {

            if ($('.banner').hasClass('error')) {
                $('.banner').removeClass('error');
            }

            $('.banner').addClass('success').show();
        }
        else if (status === 'error') {
            if ($('.banner').hasClass('success')) {
                $('.banner').removeClass('success');
            }

            $('.banner > .banner-title').text('Error');
            $('.banner').addClass('error').show();
        }
    }

    // Handle edit form submission
    $('#editForm').submit(function(event) {
        event.preventDefault();
        $.post('dashboard.php', {
            action: 'update',
            id: $('#editId').val(),
            name: $('#editName').val(),
            matricno: $('#editMatricNo').val(),
            email: $('#editEmail').val(),
            bureau: $('#editBureau').val(),
            csrf: $('#csrf').val()
        },function(data) {
            editModal.hide();
            loadMembers();
            renderBanner(data.message, data.status);
        });
    });

    // Handle delete button click
    $('.delete-btn').click(function() {
        const selected = $('.select-member:checked');
        if (selected.length === 0) {
            alert('Please select at least one member to delete.');
            return;
        }
        const ids = selected.map(function() { return $(this).val(); }).get();
        $.post('dashboard.php', { action: 'delete', id: ids }, function(data) {
            loadMembers();
            renderBanner(data.message, data.status);
        });
    });

    // Track user activity
    let timeout;
    const timeoutDuration = 10 * 60 * 1000; // 10 minutes

    function resetTimeout() {
        clearTimeout(timeout);
        timeout = setTimeout(logout, timeoutDuration);
    }

    function logout() {
        alert('You have been logged out due to inactivity.');
        window.location.href = 'adminlog.html'; // Redirect to the login page
    }

    $(document).on('mousemove keydown click', resetTimeout);

    // Initial timeout setup
    resetTimeout();

    // Check session status
    function checkSession() {
        $.get('dashboard.php?action=check_session', function(data) {
            const status = JSON.parse(data).status;
            if (status === 'logged_out') {
                logout();
            }
        });
    }

    // Check session status periodically
    setInterval(checkSession, 5 * 60 * 1000); // Check every 5 minutes
});
