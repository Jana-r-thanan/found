<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Lost and Found</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .item-pair {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .item-box {
      width: 48%;
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 6px;
    }

    .item-box h3 {
      margin-top: 0;
    }

    .field {
      margin-bottom: 8px;
    }

    .match {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      padding-left: 6px;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <h1>Matched Lost and Found Items</h1>
  <div id="matchList"></div>

  <script>
    const items = JSON.parse(localStorage.getItem("items")) || [];
    const lostItems = items.filter(i => i.type === "Lost");
    const foundItems = items.filter(i => i.type === "found");

    function isMatch(lost, found) {
      if (lost.category !== found.category) return false;
      let matchScore = 0;
      let total = 0;

      const fieldsToCheck = {
        electronics: ["model", "imei", "description", "location"],
        transportation: ["model", "regNumber", "engineNumber", "location"],
        jewel: ["jewelType", "description", "location"]
      };

      const fields = fieldsToCheck[lost.category] || [];

      fields.forEach(field => {
        total++;
        if (lost[field] && found[field] && lost[field].toLowerCase() === found[field].toLowerCase()) {
          matchScore++;
        }
      });

      return matchScore >= Math.ceil(total * 0.6); // 60% match threshold
    }

    function createFieldElement(label, value, matched) {
      const div = document.createElement("div");
      div.className = "field" + (matched ? " match" : "");
      div.innerHTML = `<strong>${label}:</strong> ${value || "-"}`;
      return div;
    }

    function renderMatchPair(lost, found) {
      const container = document.getElementById("matchList");

      const pairDiv = document.createElement("div");
      pairDiv.className = "item-pair";

      const lostBox = document.createElement("div");
      lostBox.className = "item-box";
      lostBox.innerHTML = "<h3>Lost Item</h3>";

      const foundBox = document.createElement("div");
      foundBox.className = "item-box";
      foundBox.innerHTML = "<h3>Found Item</h3>";

      const category = lost.category;
      const fields = {
        electronics: ["model", "imei", "description", "location", "phone"],
        transportation: ["model", "regNumber", "engineNumber", "description", "location", "phone"],
        jewel: ["jewelType", "description", "location", "phone"]
      }[category] || [];

      fields.forEach(field => {
        const isMatched = lost[field] && found[field] && lost[field].toLowerCase() === found[field].toLowerCase();
        lostBox.appendChild(createFieldElement(field, lost[field], isMatched));
        foundBox.appendChild(createFieldElement(field, found[field], isMatched));
      });

      pairDiv.appendChild(lostBox);
      pairDiv.appendChild(foundBox);
      container.appendChild(pairDiv);
    }

    lostItems.forEach(lost => {
      foundItems.forEach(found => {
        if (isMatch(lost, found)) {
          renderMatchPair(lost, found);
        }
      });
    });
  </script>
</body>
</html>
