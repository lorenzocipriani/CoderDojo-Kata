$(".alpha-filter").not(".no-js").each(function(){var e=$(this);if(!e.data("filter-initialized")){var i=e.find(".filters>*[data-filter]"),t=e.find(".filter-elements>*[data-filter]");i.off("click.alpha-filter").not(".disabled").on("click.alpha-filter",function(){var e=$(this),l=e.data("filter");return t.hide().filter("[data-filter="+l+"]").show(),i.removeClass("selected"),e.addClass("selected"),!1}),t.hide(),e.data("filter-initialized",!0),i.filter(".selected").length>0?i.filter(".selected").triggerHandler("click"):i.not(".disabled").slice(0,1).triggerHandler("click")}});