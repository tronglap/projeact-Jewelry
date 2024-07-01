const searchButton = document.querySelector(".search");
const searchBar = document.getElementById("searchBar");

// Thêm sự kiện click vào searchButton
searchButton.addEventListener("click", function (event) {
    event.preventDefault();

    searchBar.classList.add("active");

    document.body.style.overflow = "hidden";
});

// Search product
document.getElementById("search").addEventListener("input", function () {
    let query = this.value;

    if (query.length > 1) {
        fetch(`/api/search?search=${query}`)
            .then((response) => response.json())
            .then((data) => {
                let resultContainer = document.querySelector(".result-search");
                resultContainer.innerHTML = "";

                if (data.length > 0) {
                    data.slice(0, 4).forEach((product) => {
                        let productElement = document.createElement("div");
                        productElement.className = "product-item-search";
                        productElement.innerHTML = `
                            <a href="/home/shop/detail/${product.id}" class="product-link">
                                <div class="thumb">
                                    <img src="/assets/images/${product.image_url}" alt="${product.name}">
                                </div>
                                <div class="product-content">
                                    <h3 class="product-title">${product.name}</h3>
                                    <div class="product-price">
                                        ${
                                            product.promotion
                                                ? `<span class="price sale-price active">${product.promotion.toLocaleString(
                                                      "en-US",
                                                      {
                                                          style: "currency",
                                                          currency: "USD",
                                                      }
                                                  )}</span>`
                                                : ""
                                        }
                                        <span class="price original-price ${product.promotion ? 'active' : ''}">${product.price.toLocaleString(
                                            "en-US",
                                            {
                                                style: "currency",
                                                currency: "USD",
                                            }
                                        )}</span>
                                    </div>
                                </div>
                            </a>
                        `;
                        resultContainer.appendChild(productElement);
                    });

                    if (data.length > 4) {
                        resultContainer.classList.add("scrollable");
                    } else {
                        resultContainer.classList.remove("scrollable");
                    }
                } else {
                    resultContainer.innerHTML = '<div class="no-results">No results found</div>';
                }
            });
    } else {
        document.querySelector(".result-search").innerHTML = "";
    }
});
