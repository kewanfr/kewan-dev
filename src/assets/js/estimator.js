const HOURLY = 25;

function moneyFR(n) {
  return new Intl.NumberFormat("fr-FR", {
    style: "currency",
    currency: "EUR",
  }).format(n);
}
function moneyEN(n) {
  return new Intl.NumberFormat("en-GB", {
    style: "currency",
    currency: "EUR",
  }).format(n);
}

function computeInitial(type, hours) {
  if (type === "support") return Math.max(0, hours) * HOURLY;
  if (type === "backend") return Math.max(2, hours) * HOURLY;
  if (type === "vitrine") return 350;
  if (type === "wp") return 400;
  return 0;
}

document.addEventListener("DOMContentLoaded", () => {
  const calcBtn = document.getElementById("calcBtn");
  if (!calcBtn) return;

  const typeEl = document.getElementById("type");
  const hoursEl = document.getElementById("hours");
  const hostEl = document.getElementById("host");

  const initOut = document.getElementById("initPrice");
  const monthOut = document.getElementById("monthPrice");

  const lang = document.documentElement.lang || "fr";
  const money = lang === "en" ? moneyEN : moneyFR;

  calcBtn.addEventListener("click", () => {
    const type = typeEl.value;
    const hours = Number(hoursEl.value || 0);
    const host = Number(hostEl.value || 0);

    const initial = computeInitial(type, hours);

    initOut.textContent = initial
      ? money(initial)
      : lang === "en"
        ? "Quote-based"
        : "Sur devis";
    monthOut.textContent = host ? money(host) : "—";
  });
});
