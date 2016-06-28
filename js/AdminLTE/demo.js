$(function() {
    /* For demo purposes */
    $.get(base_url+"layout_setting", function (response) {
		$.each(response.data, function(i,item){
			var layoutPage = item.layout_page;
			var skinPage = item.skin_page;
			
			var layoutSetting = '';
			var skinBlueChecked = '';
			var skinBlackChecked = '';
			if(layoutPage=='fixed'){
				layoutSetting = "checked='checked'";
			}
			if(skinPage=='skin-blue'){
				skinBlueChecked= "checked='checked'";
			}else if(skinPage=='skin-black'){
				skinBlackChecked= "checked='checked'";
			}
			var demo = $("<div />").css({
				position: "fixed",
				top: "150px",
				right: "0",
				background: "rgba(0, 0, 0, 0.7)",
				"border-radius": "5px 0px 0px 5px",
				padding: "10px 15px",
				"font-size": "16px",
				"z-index": "999999",
				cursor: "pointer",
				color: "#ddd"
			}).html("<i class='fa fa-gear'></i>").addClass("no-print");

			var demo_settings = $("<div />").css({
				"padding": "10px",
				position: "fixed",
				top: "130px",
				right: "-200px",
				background: "#fff",
				border: "3px solid rgba(0, 0, 0, 0.7)",
				"width": "200px",
				"z-index": "999999"
			}).addClass("no-print");
			demo_settings.append(
					"<h4 style='margin: 0 0 5px 0; border-bottom: 1px dashed #ddd; padding-bottom: 3px;'>Layout Options</h4>"
					+ "<div class='form-group no-margin'>"
					+ "<div class='.checkbox'>"
					+ "<label>"
					+ "<input type='checkbox' onchange='change_layout();' "+layoutSetting+" /> "
					+ "Fixed layout"
					+ "</label>"
					+ "</div>"
					+ "</div>"
					);
			demo_settings.append(
					"<h4 style='margin: 0 0 5px 0; border-bottom: 1px dashed #ddd; padding-bottom: 3px;'>Skins</h4>"
					+ "<div class='form-group no-margin'>"
					+ "<div class='.radio'>"
					+ "<label>"
					+ "<input name='skins' type='radio' onchange='change_skin(\"skin-black\");' "+skinBlackChecked+" /> "
					+ "Black"
					+ "</label>"
					+ "</div>"
					+ "</div>"

					+ "<div class='form-group no-margin'>"
					+ "<div class='.radio'>"
					+ "<label>"
					+ "<input name='skins' type='radio' onchange='change_skin(\"skin-blue\");' "+skinBlueChecked+" /> "
					+ "Blue"
					+ "</label>"
					+ "</div>"
					+ "</div>"
					);

			demo.click(function() {
				if (!$(this).hasClass("open")) {
					$(this).css("right", "200px");
					demo_settings.css("right", "0");
					$(this).addClass("open");
				} else {
					$(this).css("right", "0");
					demo_settings.css("right", "-200px");
					$(this).removeClass("open")
				}
			});

			$("body").append(demo);
			$("body").append(demo_settings);
		});
	}, "json");
});

function change_layout() {
    $("body").toggleClass("fixed");
    fix_sidebar();
}
function change_skin(cls) {
    $("body").removeClass("skin-blue skin-black");
    $("body").addClass(cls);
    $("#naviJarvis").removeClass("bg-black bg-light-blue");
    if(cls=='skin-blue'){
		navCls='bg-light-blue';
	}else{
		navCls='bg-black';
	}
    $("#naviJarvis").addClass(navCls);
	$.post(base_url+"layout_setting/setting/skin_page", { skin_page: cls } );
}
