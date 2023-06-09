const paymentConfirm = async(details)=>{
    try {
        const uri = `/api/transaction/create`;
        const submit = await fetch(uri, {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(payload),
        });
        const res = await submit.json(),
            data = res;

        if (res.type === "success") {
            alertMessage("success", res.message);
            // window.location.href = "/my-ticket";
            // await call(confirmDetails, trans_details);
        }  message(res.type, res.message);
          
    } catch (error) {
        await put(userActions.setError(error));
        await put(setIsLoading(false));
    }
}