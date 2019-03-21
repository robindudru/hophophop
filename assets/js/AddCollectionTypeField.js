class AddCollectionTypeField {
    constructor(type) {
        switch (type) {
            case 'malts':
                this.buttonLabel = 'Malt';
                break;
            case 'hops':
                this.buttonLabel = 'Houblon';
                break;
            case 'others':
                this.buttonLabel = 'Autre ingrédient';
                break;
        }
        this.collectionHolder = $(`ul.${type}`);
        this.FormLi = this.collectionHolder.find('li');
        for(i=0; i < this.FormLi.length; i++) {
            this.addFormDeleteLink(this.FormLi[i]);
        };
        this.addButton = $(`<a href="#" class="btn btn-info">Ajouter un ${this.buttonLabel}</a>`);
        this.newLinkLi = $('<li class="text-center"></li>').append(this.addButton);
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
        let removeFormButton = $('<a href="#" class="btn btn-danger text-right mb-5">Supprimer <i class="fas fa-times"></i></a>');
        $(FormLi).append(removeFormButton);

        removeFormButton.click((e) => {
            e.preventDefault();
            $(FormLi).remove();
        });
    }
}

var maltFields = new AddCollectionTypeField('malts');
var hopFields = new AddCollectionTypeField('hops');
var otherFields = new AddCollectionTypeField('others');