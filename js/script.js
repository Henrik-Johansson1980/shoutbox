//Make sure Document is ready 
$(document).ready( function () {
    $('#submit').on('click', function(e) {
        // e.preventDefault();
        let name = $('#name').val();
        let shout = $('#shout').val();
        let date = getDate();
        let dataString = `name=${name}&shout=${shout}&date=${date}`;

        //Validation 
        if(name == '' || shout == '') {
            alert('Please fill in your name and shout...');
        }else {
            $.ajax({
                type: "POST",
                url: "../shoutbox.php",
                data: dataString,
                cache: false,
                success: function(html) {
                    $('#shouts').prepend(html);
                }
            })
            //Clear shout input field
            $('#shout').val('');
        }
        return false;
    });

});

// Return a MySQL formatted date
function getDate() {
    let date = new Date;
    date = date.getUTCFullYear() + '-' +
        ('00' + (date.getUTCMonth() + 1 )).slice(-2) + '-' +
        ('00' + date.getUTCDate()).slice(-2) + ' ' +
        ('00' + date.getUTCHours()).slice(-2) + ':' +
        ('00' + date.getUTCMinutes()).slice(-2) + '_' +
        ('00' + date.getUTCSeconds()).slice(-2);
    return date;
}
