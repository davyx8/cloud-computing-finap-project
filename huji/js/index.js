var COMPUTERS = null;
var selectedComputers = [];

$(document).ready
(
	function()
	{
		loadLab();
		checkCookie();
	}
);

function checkCookie()
{
	if (document.cookie.indexOf("user[id]") >= 0)
	{
		$("#divNotRegistered").hide();
		$("#divRegister").show();
	
		var start = document.cookie.indexOf("user[user_name]=") + 16;
		var end = document.cookie.indexOf(";", start);
		if (end == -1)
		{
			end = document.cookie.length;
		}
		var userName = decodeURIComponent(document.cookie.substring(start, end).split("+").join(" "));

		$("#spnUserName").html(userName);
	}
	else
	{
		$("#divNotRegistered").show();
		$("#divRegister").hide();
	}
}

function loadLab()
{
	var labID = $("#slctAquariumID").val() * 1;

	$("#divMap div > div").remove();
	$("#divMap div.map").css("background", "url('maps/" + labID + ".png') no-repeat scroll left top rgba(0, 0, 0, 0)");

	$.get
	(
		"ajax/get_comps_by_lab.php",
		//"ajax/" + labID + ".json",
		{
			lab: labID
		},
		function(json)
		{
			COMPUTERS = json;
			setCoordinates(COMPUTERS);
		},
		"json"
	);
}

function setCoordinates(computers)
{
	var div;
	var computer;
	var content;
	var parent = $("#divMap div");
	var counts = [0, 0, 0, 0];
	var text;
	var CSS =
	{
		borderRadius: 5,
		boxShadow: 0,
		minLifetime: 0,
		showDuration: 0,
		hideDuration: 0,
		padding: "10px",
		backgroundColor: "lightgray",
		color: "black",
		direction: "rtl",
		"text-align": "right"
	};

	for (var i = 0; i < computers.length; i++)
	{
		computer = computers[i];
		/*if (computer.statusID == 4)
		{
			content = "<div class=\"inner\">x</div>";
		}
		else
		{*/
			content = "&nbsp;";
		//}

		div = $(document.createElement("div"));
		div.attr("id", "divComp" + computer.id)
			.attr("onclick", "selectComputer(" + computer.id + ");")
			.html(content)
			.addClass("computer")
			.addClass("status" + computer.statusID)
			.css("left", computer.x1 + "px")
			.css("top", computer.y1 + "px");

		text = "<div class=\"computerInfo\">\
					<h3>" + computer.name + "</h3>\
					<h4>" + computer.ip + "</h4>";

		if ((computer.statusID == 2) || (computer.statusID == 3))
		{
			text += "<span class=\"usage\">\
			 			" + (computer.statusID == 2 ? "שמור עבור" : "משתמש") + ":\
						<span class=\"student\">" + computer.studentID + "</span>\
					</span>";
		}
		text += "</div>";

		div.balloon
		(
			{
				contents: text,
				css: CSS,
				position: "top"
			}
		);

		parent.append(div);
		counts[computer.statusID - 1]++;
	}

	for (var i = 0; i < counts.length; i++)
	{
		$("#divOccupacity" + (i + 1)).html(counts[i]);
	}

	selectedComputers = [];
	$("#spnRegisterCount").html("0");
}

function selectComputer(computerID)
{
	if (document.cookie.indexOf("user[id]") == -1)
	{
		return;
	}

	if ($.inArray(computerID, selectedComputers) >= 0)
	{
		$("#divComp" + computerID).removeClass("selected");
		selectedComputers.splice(selectedComputers.indexOf(computerID), 1);
	}
	else
	{
		var available = $("#divComp" + computerID).hasClass("status1");
		if ((selectedComputers.length >= 3) || (available == false))
		{
			return;
		}
		$("#divComp" + computerID).addClass("selected");
		selectedComputers.push(computerID);
	}
	$("#spnRegisterCount").html(selectedComputers.length);
	if (selectedComputers.length == 0)
	{
		$("#btnReserve").attr("disabled", "disabled");
	}
	else
	{
		$("#btnReserve").removeAttr("disabled");
	}
}

function login()
{
	loadMiniPage("login.php");
}

function reserve()
{
	var computers = selectedComputers.join(",");
	loadMiniPage("order.php?computers=" + computers);
}

function loadMiniPage(url)
{
	$("#ifrmPages").attr("src", url)
		.slideDown("slow");

}

function closeMiniPage(url)
{
	$("#ifrmPages").slideUp("slow")
		.attr("src", "about:blank");
}
