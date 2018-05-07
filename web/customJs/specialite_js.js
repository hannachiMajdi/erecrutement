var $collectionSpecialiteHolder;

// setup an "add a expeience" link
var $addSpecialiteLink = $('<a href="#" class="add_specialite_link"> + Ajouter une specialite</a>');
var $newLinkSpecialiteLi = $('<li></li>').append($addSpecialiteLink);

jQuery(document).ready(function() {

    // Get the ul that holds the collection of expeiences
    $collectionSpecialiteHolder = $('ul.specialites');
    // add a delete link to all of the existing tag form li elements
    $collectionSpecialiteHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    // add the "add a expeience" anchor and li to the expeiences ul
    $collectionSpecialiteHolder.append($newLinkSpecialiteLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionSpecialiteHolder.data('index', $collectionSpecialiteHolder.find(':input').length);

    $('.add_specialite_link').on('click', function(e) {
        console.log('called');
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new expeience form (see next code block)
        addSpecialiteForm($collectionSpecialiteHolder, $newLinkSpecialiteLi);

    });

});
function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#" > - Effacer Cette specialite</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}
function addSpecialiteForm($collectionSpecialiteHolder, $newLinkSpecialiteLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionSpecialiteHolder.data('prototype');

    // get the new index
    var index = $collectionSpecialiteHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your expeiences field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionSpecialiteHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a expeience" link li
    var $newFormLi = $('<li></li>').append(' <div class="content-box"><div class="content-box-wrapper">'+newForm+'</div></div>');
    $newLinkSpecialiteLi.before($newFormLi);
    addTagFormDeleteLink($newFormLi);
}


