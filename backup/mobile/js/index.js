var LAB_IS = null;
var COMPUTERS = null;

$(document).ready
(
	function()
	{
		$.get
		(
			"../ajax/get_comps_by_lab.php",
			{
				lab: LAB_ID
			},
			function(json)
			{
				COMPUTERS = json;
				setCoordinates(COMPUTERS);
			},
			"json"
		);

		$("#divMap > div").css("background", "url('../maps/" + LAB_ID + ".png') no-repeat left top");
	}
);

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
		if (computer.statusID == 4)
		{
			content = "<div class=\"inner\">x</div>";
		}
		else
		{
			content = "&nbsp;";
		}

		div = $(document.createElement("div"));
		div.html(content)
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
		$("#ulExplanation li.status" + (i + 1) + " span.count").html("(" + counts[i] + ")");
	}
}
