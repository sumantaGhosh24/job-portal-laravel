import "./bootstrap";

const themeToggle = document.getElementById("themeToggle");
if (themeToggle) {
    themeToggle.addEventListener("click", () => {
        document.documentElement.classList.toggle("dark");
        const isDark = document.documentElement.classList.contains("dark");
        localStorage.setItem("theme", isDark ? "dark" : "light");
        themeToggle.innerHTML = isDark ? "🌙" : "🌞";
    });
}

if (localStorage.theme === "dark") {
    document.documentElement.classList.add("dark");
    themeToggle.innerHTML = "🌙";
} else {
    document.documentElement.classList.remove("dark");
    themeToggle.innerHTML = "🌞";
}
