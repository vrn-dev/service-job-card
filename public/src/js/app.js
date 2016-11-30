var companyId               = 0;
var companyNameElement      = null;
var contactNameElement      = null;
var contactTelElement       = null;
var contactMobileElement    = null;
var contactEmailElement     = null;
var cityElement             = null;
var countryElement          = null;
var addressElement          = null;

// Open Modal
$('#add-co-btn').on('click', function(){
    $('#add-modal').modal();
});

//Open Edit Modal and Populate DB Entry
$('.row').find('.table-responsive').find('.companyTable').find('.tbody-company').find('.company-row').find('.td-edit').find('.co-details-from-db').on('click', function (event) {
    event.preventDefault();

    companyNameElement  = event.target.parentNode.parentNode.childNodes[3];
    contactNameElement  = event.target.parentNode.parentNode.childNodes[5];
    contactTelElement   = event.target.parentNode.parentNode.childNodes[7];
    contactMobileElement = event.target.parentNode.parentNode.childNodes[9];
    contactEmailElement = event.target.parentNode.parentNode.childNodes[11];
    cityElement         = event.target.parentNode.parentNode.childNodes[13];
    countryElement      = event.target.parentNode.parentNode.childNodes[15];
    addressElement      = event.target.parentNode.parentNode.childNodes[17];

    companyId           = $(this).data('companyid');
    var companyName     = $.text(companyNameElement);
    var contactName     = $.text(contactNameElement);
    var contactTel      = $.text(contactTelElement);
    var contactMobile   = $.text(contactMobileElement);
    var contactEmail    = $.text(contactEmailElement);
    var city            = $.text(cityElement);
    var country         = $.text(countryElement);
    var address         = $.text(addressElement);

    $('#company-name-edit-modal').val(companyName);
    $('#contact-name-edit-modal').val(contactName);
    $('#contact-tel-edit-modal').val(contactTel);
    $('#contact-mobile-edit-modal').val(contactMobile);
    $('#contact-email-edit-modal').val(contactEmail);
    $('#city-edit-modal').val(city);
    $('#country-edit-modal').val(country);
    $('#address-edit-modal').val(address);
    $('#edit-modal').modal('show');

});

// Edit Modal Save Button
$('#edit-modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: edit_url,
        data: {
            companyId:      companyId,
            companyName:    $('#company-name-edit-modal').val(),
            contactName:    $('#contact-name-edit-modal').val(),
            contactTel:     $('#contact-tel-edit-modal').val(),
            contactMobile:  $('#contact-mobile-edit-modal').val(),
            contactEmail:   $('#contact-email-edit-modal').val(),
            city:           $('#city-edit-modal').val(),
            country:        $('#country-edit-modal').val(),
            address:        $('#address-edit-modal').val(),
            _token:         edit_token
        }
    })
        .done(function (msg) {
            $(companyNameElement).text(msg['new_companyName']);
            $(contactNameElement).text(msg['new_contactName']);
            $(contactTelElement).text(msg['new_contactTel']);
            $(contactMobileElement).text(msg['new_contactMobile']);
            $(contactEmailElement).text(msg['new_contactEmail']);
            $(cityElement).text(msg['new_city']);
            $(countryElement).text(msg['new_country']);
            $(addressElement).text(msg['new_address']);
            $('#edit-modal').modal('hide');
        });//send new data to the updated table without refreshing
});

