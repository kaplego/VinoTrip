type Status =
    | "pending"
    | "accepted"
    | "canceled"
    | "failed"
    | "max_attempts_reached"
    | "deleted"
    | "expired";

interface BaseResult {
    ok: boolean;
    status: Status;
}

interface ErrorResult extends BaseResult {
    ok: false;
    status: Exclude<Status, "accepted">;
}

interface SuccessResult extends BaseResult {
    ok: true;
}

type Result = ErrorResult | SuccessResult;

type CheckResult =
    | {
          ok: true;
          status: "enabled" | "disabled";
      }
    | {
          ok: false;
          error: string;
      };

export default class A2F {
    protected buttons: HTMLButtonElement[];
    protected _verifying: boolean = false;
    protected ready: boolean = false;
    protected readonly url: string;

    public get verifying() {
        return this._verifying;
    }

    protected toggleButtons(value: boolean) {
        this.buttons.forEach((button) => {
            button.disabled = !value;
        });
    }

    constructor(buttons: HTMLButtonElement[], url: string) {
        this.buttons = buttons;
        this.url = url;
    }

    async init(callback?: (verifying: boolean) => Promise<unknown> | unknown) {
        this.toggleButtons(false);
        const res = await axios.get<Result>(this.url);
        if (res.data.ok && res.data.status && res.data.status === "pending")
            this._verifying = true;
        this.ready = true;
        await callback?.(this._verifying);
        this.toggleButtons(true);
    }

    async start(callback?: (result: boolean) => Promise<unknown> | unknown) {
        if (this.ready && !this._verifying) {
            this.toggleButtons(false);
            const res = await axios.put<Result>(this.url);
            callback?.(
                res.data.ok && res.data.status && res.data.status === "pending"
            );
            this._verifying = true;
            this.toggleButtons(true);
            return;
        }
        await callback?.(false);
    }

    async check(
        code: string,
        callback?: (result: CheckResult) => Promise<unknown> | unknown
    ) {
        if (this.ready && this._verifying) {
            this.toggleButtons(false);
            const fd = new FormData();
            fd.set("code", code);
            const res = await axios.post<CheckResult>(this.url, fd);
            callback?.(res.data);
            this.toggleButtons(true);
            return;
        }
        await callback?.({
            ok: false,
            error: "Une erreur est survenue.",
        });
    }

    async cancel(callback?: (ok: boolean) => Promise<unknown> | unknown) {
        this.toggleButtons(false);
        const res = await axios.delete<Result>(this.url);
        if (res.data.ok)
            this._verifying = false;
        await callback?.(res.data.ok);
        this.toggleButtons(true);
    }
}
