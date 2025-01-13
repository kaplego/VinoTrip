export default class A2F {
    buttons;
    _verifying = false;
    ready = false;
    url;
    get verifying() {
        return this._verifying;
    }
    toggleButtons(value) {
        this.buttons.forEach((button) => {
            button.disabled = !value;
        });
    }
    constructor(buttons, url) {
        this.buttons = buttons;
        this.url = url;
    }
    async init(callback) {
        this.toggleButtons(false);
        const res = await axios.get(this.url);
        if (res.data.ok && res.data.status && res.data.status === "pending")
            this._verifying = true;
        this.ready = true;
        await callback?.(this._verifying);
        this.toggleButtons(true);
    }
    async start(callback) {
        if (this.ready && !this._verifying) {
            this.toggleButtons(false);
            const res = await axios.put(this.url);
            callback?.(res.data.ok && res.data.status && res.data.status === "pending");
            this._verifying = true;
            this.toggleButtons(true);
            return;
        }
        await callback?.(false);
    }
    async check(code, callback) {
        if (this.ready && this._verifying) {
            this.toggleButtons(false);
            const fd = new FormData();
            fd.set("code", code);
            const res = await axios.post(this.url, fd);
            callback?.(res.data);
            this.toggleButtons(true);
            return;
        }
        await callback?.({
            ok: false,
            error: "Une erreur est survenue.",
        });
    }
    async cancel(callback) {
        this.toggleButtons(false);
        const res = await axios.delete(this.url);
        if (res.data.ok && res.data.status && res.data.status === "canceled")
            this._verifying = false;
        await callback?.(this._verifying);
        this.toggleButtons(true);
    }
}
