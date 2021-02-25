export default class {
    constructor(errors = {})
    {
        this.errors = errors;
    }

    has(key)
    {
        return this.errors.hasOwnProperty(key);
    }

    first(key)
    {
        if (this.errors[key] && this.errors[key].constructor === Array) {
            return this.errors[key][0];
        }

        return '';
    }
}
