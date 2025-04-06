document.addEventListener("DOMContentLoaded", function () {
    let items = JSON.parse(localStorage.getItem("items")) || [];

    function displayItems() {
        const itemsList = document.getElementById("itemsList");
        if (!itemsList) return;
        itemsList.innerHTML = "";
        items.forEach((item, index) => {
            let match = findMatchingItem(item);
            itemsList.innerHTML += `
                <li ${match ? 'style="background-color: lightgreen;"' : ""}>
                    <strong>Type:</strong> ${item.type}<br>
                    <strong>Category:</strong> ${item.category}<br>
                    <strong>Item:</strong> ${item.itemName}<br>
                    <strong>Description:</strong> ${item.description}<br>
                    <strong>Date:</strong> ${item.date}<br>
                    <strong>Location:</strong> ${item.location}<br>
                    ${match ? `<strong>Possible Match Found:</strong> ${match.itemName} (${match.type})<br>` : ""}
                    <button class="delete-btn" data-index="${index}">Remove</button>
                </li>
            `;
        });

        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                const index = this.getAttribute("data-index");
                items.splice(index, 1);
                localStorage.setItem("items", JSON.stringify(items));
                displayItems();
            });
        });
    }

    function findMatchingItem(currentItem) {
        if (currentItem.type === "Lost") {
            return items.find(item =>
                item.type === "Found" &&
                item.category === currentItem.category &&
                item.itemName.toLowerCase() === currentItem.itemName.toLowerCase()
            );
        }
        return null;
    }

    if (document.getElementById("lostFoundForm")) {
        document.getElementById("lostFoundForm").addEventListener("submit", function (event) {
            event.preventDefault();
            let newItem = {
                type: document.querySelector('input[name="type"]:checked').value,
                category: document.getElementById("category").value,
                itemName: document.getElementById("item").value,
                imei: document.getElementById("imei")?.value || "",
                description: document.getElementById("description").value,
                date: document.getElementById("date").value,
                location: document.getElementById("location").value
            };
            items.push(newItem);
            localStorage.setItem("items", JSON.stringify(items));
            alert("Item Submitted Successfully!");
            window.location.href = "index.php";
        });
    }





    displayItems();
});
