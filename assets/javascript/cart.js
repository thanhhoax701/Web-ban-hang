// function cart() {
//     window.location.href = "don-hang.php"
// }

// ----------------------- Danh sách các sản phẩm -----------------------
var itemList = {
    "sp001": {
        name: "Đồng hồ nam chính hãng Casio",
        price: 590000,
        photo: "/img/product/dong-ho.jpg",
    },

    "sp002": {
        name: "Ví nam cầm tay VARADO VD090D kẻ caro thời trang sành điệu",
        price: 89000,
        photo: "/img/product/vi-dai.jpg",
    },

    "sp003": {
        name: "Bộ Ví Da + Thắt Lưng Bostanten Chất Lượng Cao Bằng Da Bò Thật Cho Nam",
        price: 390000,
        photo: "/img/product/vi+thatlung.jpg",
    },

    "sp004": {
        name: "Khẩu trang y tế cao cấp 4 lớp kháng khuẩn Famapro Premium",
        price: 117000,
        photo: "/img/product/khautrang.webp",
    },

    "sp005": {
        name: "Gấu Bông Chó Husky Siêu To Khổng Lồ Cao Cấp Memon",
        price: 130000,
        photo: "/img/product/gau-bong.jpg",
    },

    "sp006": {
        name: "Gấu bông Among us 20cm xinh xắn",
        price: 120000,
        photo: "/img/product/amongus.jpg",
    },

    "sp007": {
        name: "Nike Air Jordan 1 Mid Dutch Green Rep 1:1",
        price: 798000,
        photo: "/img/product/Nike-Air-Jordan-1-Mid-Dutch-Green-rep11-300x300.jpg",
    },

    "sp008": {
        name: "Nike Air Jordan 1 Low Wolf Grey Rep 1:1",
        price: 898000,
        photo: "/img/product/Jordan-1-Low-Wolf-Grey-800x600.jpg",
    },

    "sp009": {
        name: "Giày Air Jordan 1 Light Smoke Grey Low Rep 1:1",
        price: 800000,
        photo: "/img/product/jordan-smoke.jpg",
    },
    "sp010": {
        name: "Áo Khóac Nhung Tâm Jacket Varsity Form Rộng Gonz",
        price: 749000,
        photo: "/img/product/khoac-varsity.jpg",
    },
    "sp011": {
        name: "Áo hoodie Essentials in cao su khoác hoodie nỉ bông hàng cao cấp",
        price: 29000,
        photo: "/img/product/ao-hoodie.jpg",
    },
    "sp012": {
        name: "Mũ lưỡi trai ESSENTIALS Fear Of God Nón kết nam FOG Essential Logo Silicone 3D in sắc nét",
        price: 15000,
        photo: "/img/product/non-ket.jpg",
    },
    "sp013": {
        name: "Mũ Len Vintage Cá Tính YORN - Hàng Nhập Khẩu",
        price: 75000,
        photo: "/img/product/mu-len.jpg",
    },
    "sp014": {
        name: "Dép cross, Dép Sục Nữ Nam duet Hàn Quốc Đi Mưa Cao Cấp Đẹp Hot Nhất 2021 Trống Trơn Trượt, Độ Bền Cao",
        price: 230000,
        photo: "/img/product/Dep-cross.jpg",
    },
    "sp015": {
        name: "💥Hàng sẵn💥 Dép Jodan Hydro Quai Ngang Bóng Rổ Jd6 Nhiều Màu Nam Nữ 💥 Dép Quai Ngang",
        price: 200000,
        photo: "/img/product/Dep-jodan.jpg",
    },
    "sp016": {
        name: "Giày Casual Đơn Giản",
        price: 320000,
        photo: "/img/product/giay-casual.jpg",
    },
    "sp017": {
        name: "Dép Casual Đơn Giản",
        price: 220000,
        photo: "/img/product/depA3.jpg",
    },
    "sp018": {
        name: "Set Blazer phong cách Hàn Quốc",
        price: 429000,
        photo: "/img/product/ao-blazer.jpg",
    },
    "sp019": {
        name: "Áo khoác DirtyCoins Print Cardigan",
        price: 490000,
        photo: "/img/product/ao-cadigan.jpg",
    },
    "sp020": {
        name: "Áo Gile trơn (Hàng đang về)",
        price: 150000,
        photo: "/img/product/ao-gile.jpg",
    },
    "sp021": {
        name: "Áo quần bộ đồ noel giáng sinh cho bé trai bé gái Minky Mom [Chuẩn 100% cotton] Quần áo đồ ông già noel giáng sinh trẻ em",
        price: 95000,
        photo: "/img/product/do-noel.jpg",
    },
    "sp022": {
        name: "Cây thông Noel 1m6 đủ phụ kiện 🎄 FREESHIP 🎄 Cây thông Noel trang trí đầy đủ phụ kiện đi kèm cao 1.6m",
        price: 295000,
        photo: "/img/product/caythongnoel.jpg",
    },
};

// ----------------------- Thêm sản phẩm -----------------------
function addCart(code) {
    //lấy giá trị số lượng sảm phẩm từ input
    var number = parseInt(document.getElementById(code).value);
    if (number <= 0) {
        alert('Vui lòng nhập số lượng')
        return;
    }
    if (number > 100) {
        alert("Sản phẩm vượt quá số lượng");
        return;
    }
    //khi sản phẩm chưa được thêm vào trước đó
    if (typeof localStorage[code] === "undefined") {
        alert('Thêm sản phẩm thành công')
        window.localStorage.setItem(code, number);
    }
    //Khi sản phẩm đã thêm vào trc đó
    else {
        var current = parseInt(window.localStorage.getItem(code));
        if (current + number > 100) {
            window.localStorage.setItem(code, 100);
            alert("Sản phẩm vượt quá số lượn");
        } else {
            window.localStorage.setItem(code, current + number);
            alert('Thêm sản phẩm thành công')
        }
    }
    document.getElementById(code).value = 0
}

// ----------------------- Hiển thị giỏ hàng -----------------------
function showCart() {
    // Cho giá trị tổng ban đầu bằng 0 rồi đi qua vòng lặp, xét từng biến
    TotalPreTax = 0;
    for (const [key, item] of Object.entries(itemList)) {
        var in_cart = localStorage.getItem(key)
        if (in_cart) {
            photo = item.photo
            name = item.name
            price = item.price
            orderNumber = localStorage.getItem(key);
            TotalProduct = price * orderNumber
            TotalPreTax += TotalProduct;

            // Dòng chứa ô dữ liệu
            var tr = document.createElement("tr")
                // ô dữ liệu chứa hình ảnh ,tên sản phẩm, số lượng, giá ban và thành tiền
            var phototd = document.createElement("td")
            phototd.innerHTML = "<img src='./assets" + photo + "'/>";
            phototd.className = "container__order"
            tr.appendChild(phototd)

            var nametd = document.createElement("td")
            nametd.innerHTML = name
            tr.appendChild(nametd)

            var orderNumbertd = document.createElement("td")
            orderNumbertd.innerHTML = orderNumber
            tr.appendChild(orderNumbertd)

            var pricetd = document.createElement("td")
            pricetd.innerHTML = convertVND(price)
            tr.appendChild(pricetd)

            var TotalProducttd = document.createElement("td")
            TotalProducttd.innerHTML = convertVND(TotalProduct)
            tr.appendChild(TotalProducttd)

            var idele = document.createElement("td")
            idele.innerHTML = '<a href="#!" id="delete-' + key + '" onclick="removeCart(\'' + key + '\')"> <i style="color: red;" class="fa fa-trash-alt"></i> </a>'
            idele.className = "container__order"
            tr.appendChild(idele)

            // thêm dòng vào table-tbody
            var botytd = document.getElementById("product-detail")
            botytd.appendChild(tr)

        }
    }
    document.getElementById("total").innerHTML = "Tổng thành tiền = " + convertVND(TotalPreTax)
}

// ----------------------- Chuyển đổi sang VND -----------------------
function convertVND(money) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(money)
}

// ----------------------- Xóa giỏ hàng khỏi localStorage -----------------------
function removeCart(code) {
    if (typeof window.localStorage[code] !== "undefined") {
        window.localStorage.removeItem(code);
        document.getElementById("product-detail").innerHTML = "";
        showCart();
    }
}

if (document.getElementById('product-detail')) {
    showCart();
}