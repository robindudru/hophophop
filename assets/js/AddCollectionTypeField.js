class AddCollectionTypeField {
    constructor(type) {
        switch (type) {
            case 'malts':
                this.buttonLabel = 'Malt';
                break;
            case 'hops':
                this.buttonLabel = 'Houblon';
        }
        this.collectionHolder = $(`ul.${type}`);
        this.FormLi = this.collectionHolder.find('li');
        for(i=0; i < this.FormLi.length; i++) {
            this.addFormDeleteLink(this.FormLi[i]);
        };
        this.addButton = $(`<a href="#" class="btn btn-info">Ajouter un ${this.buttonLabel}</a>`);
        this.newLinkLi = $('<li></li>').append(this.addButton);
        this.collectionHolder.append(this.newLinkLi);
        this.collectionHolder.data('index', this.collectionHolder.find(':input').length);
        this.addButton.click((e) => {
            e.preventDefault();
            this.addForm(this.collectionHolder, this.newLinkLi);
        });
    }

    addForm(collectionHolder, newLinkLi) {
        let prototype = collectionHolder.data('prototype');
        let index = collectionHolder.data('index');
        let newForm = prototype;

        newForm = newForm.replace(/__name__/g, index);

        collectionHolder.data('index', index + 1);

        let newFormLi = $('<li></li>').append(newForm);
        newLinkLi.before(newFormLi);
        this.addFormDeleteLink(newFormLi);
    }

    addFormDeleteLink(FormLi) {
        let removeFormButton = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $(FormLi).append(removeFormButton);

        removeFormButton.click((e) => {
            e.preventDefault();
            $(FormLi).remove();
        });
    }
}

var maltFields = new AddCollectionTypeField('malts');
var hopFields = new AddCollectionTypeField('hops');