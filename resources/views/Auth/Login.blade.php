<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Maple Salon - Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --primary: #891b96;
      --secondary: #d434bc;
      --accent: #c77dff;
      --light: #faf5ff;
      --dark: #3a0a3a;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    
    .login-container {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 450px;
      overflow: hidden;
      position: relative;
      z-index: 1;
    }
    
    .login-header {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white;
      padding: 30px;
      text-align: center;
      position: relative;
    }
    
    .login-header h2 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    
    .login-header p {
      opacity: 0.9;
    }
    
    .login-header::after {
      content: '';
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 0;
      border-left: 20px solid transparent;
      border-right: 20px solid transparent;
      border-top: 20px solid var(--secondary);
    }
    
    .login-body {
      padding: 40px;
    }
    
    .form-group {
      margin-bottom: 25px;
      position: relative;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark);
    }
    
    .input-icon {
      position: absolute;
      top: 40px;
      left: 15px;
      color: var(--primary);
    }
    
    .form-control {
      width: 100%;
      padding: 12px 15px 12px 45px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s;
    }
    
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(137, 27, 150, 0.2);
      outline: none;
    }
    
    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    
    .remember-me {
      display: flex;
      align-items: center;
    }
    
    .remember-me input {
      margin-right: 8px;
      accent-color: var(--primary);
    }
    
    .forgot-password {
      color: var(--primary);
      text-decoration: none;
      font-size: 14px;
      transition: color 0.3s;
    }
    
    .forgot-password:hover {
      color: var(--secondary);
      text-decoration: underline;
    }
    
    .login-btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(137, 27, 150, 0.3);
    }
    
    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(137, 27, 150, 0.4);
    }
    
    .login-footer {
      text-align: center;
      margin-top: 25px;
      color: #666;
    }
    
    .login-footer a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }
    
    .login-footer a:hover {
      text-decoration: underline;
    }
    
    /* Decorative elements */
    .decorative-circle {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      z-index: -1;
    }
    
    .circle-1 {
      width: 200px;
      height: 200px;
      top: -50px;
      left: -50px;
    }
    
    .circle-2 {
      width: 150px;
      height: 150px;
      bottom: -30px;
      right: -30px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 480px) {
      .login-body {
        padding: 30px 20px;
      }
      
      .login-header {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <!-- Decorative background elements -->
  <div class="decorative-circle circle-1"></div>
  <div class="decorative-circle circle-2"></div>

  <div class="login-container">
    <div class="login-header">
      <h2>Form Login</h2>
      <p>Sign in to your Maple Salon account</p>
    </div>
    
    <div class="login-body">
      <form action="{{ route('loginprocess') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="email">Email Address</label>
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" id="email" name="email" class="form-control" required placeholder="your@email.com">
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <i class="fas fa-lock input-icon"></i>
          <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
        </div>
        
        <div class="remember-forgot">
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
          </div>
          <a href="#" class="forgot-password">Forgot password?</a>
        </div>
        
        <button type="submit" class="login-btn">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
      </form>
      
      <div class="login-footer">
        {{-- <p>Don't have an account? <a href="#">Contact administrator</a></p> --}}
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add animation to form elements
      const formGroups = document.querySelectorAll('.form-group');
      formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(20px)';
        group.style.transition = `all 0.5s ease ${index * 0.1}s`;
        
        setTimeout(() => {
          group.style.opacity = '1';
          group.style.transform = 'translateY(0)';
        }, 100);
      });
      
      // Add focus effects
      const inputs = document.querySelectorAll('.form-control');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.querySelector('.input-icon').style.color = 'var(--secondary)';
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.querySelector('.input-icon').style.color = 'var(--primary)';
        });
      });
    });
  </script>
</body>
</html>