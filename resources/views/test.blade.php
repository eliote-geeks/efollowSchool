<base href="/">
<x-layouts>

      <style>
    :root {
      --primary-color: #007bff;
      --secondary-color: #6c757d;
      --bg-color: #f8f9fa;
      --menu-item-hover: #e9ecef;
      --menu-item-scale: 1.1;
      --grid-color: #dee2e6;
    }

    .navbar {
      background-color: var(--primary-color);
    }

    .navbar-icon {
      color: #fff;
      font-size: 24px;
      cursor: pointer;
      transition: transform 0.3s;
    }

    .navbar-icon:hover {
      transform: scale(1.1);
    }

    .popup-menu {
      position: absolute;
      background-color: #fff;
      box-shadow: 4px 4px 9px rgba(0, 0, 0, 0.1);
      padding: 20px;
      display: none;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: repeat(2, 1fr);
      grid-gap: 20px;
      max-width: 800px;
      border-radius: 8px;
      animation: slideDown 0.3s ease-in-out;
      font-weight: bold;
    }

    .popup-menu.show {
      display: grid;
    }

    .menu-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      cursor: pointer;
      padding: 10px;
      border-radius: 8px;
      transition: background-color 0.3s, transform 0.3s;
      position: relative;
    }

    .menu-item:before {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      border: 1px solid var(--grid-color);
      border-radius: 8px;
      pointer-events: none;
    }

    .menu-item:hover {
      background-color: var(--menu-item-hover);
      transform: scale(var(--menu-item-scale));
    }

    .menu-item i {
      font-size: 30px;
      margin: 22px;
      color: var(--primary-color);
    }

    .menu-item span {
      font-size: 14px;
      color: var(--secondary-color);
    }

    @keyframes slideDown {
      0% {
        transform: translateY(-20px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @media (max-width: 767px) {
      .popup-menu {
        width: 100%;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 1fr);
      }
    }
  </style>

</x-layouts>