$(".has-emoji").each(function() {
        var original = $(this).html();
        // use .shortnameToImage if only converting shortnames (for slightly better performance)
        var converted = emojione.shortnameToUnicode(original);
        $(this).html(converted);
    });
