function checkOnlyOne(checkbox) {
        var checkboxes = document.getElementsByName('payment_method');
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false;
        });
    }
