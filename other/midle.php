<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testimonial Section</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }

    h2 {
      font-size: 2rem;
      margin-bottom: 40px;
      color: #333;
    }

    .testimonials {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .testimonial {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: left;
    }

    .stars {
      color: #e91e63;
      margin-bottom: 10px;
    }

    .testimonial p {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 10px;
    }

    .testimonial .author {
      font-weight: bold;
      font-size: 0.9rem;
      color: #333;
    }

    .dots {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      gap: 8px;
    }

    .dot {
      width: 10px;
      height: 10px;
      background-color: #ccc;
      border-radius: 50%;
      transition: background-color 0.3s;
    }

    .dot.active {
      background-color: #e91e63;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>What our Clove Urban Farmers say</h2>
    <div class="testimonials">
      <div class="testimonial">
        <div class="stars">★★★★★</div>
        <p>I've always wanted to have plants in my home, but not being an expert in the art of taking care of greenery, I've always opted for alternative solutions, such as fake plants. Thanks to Poty, however, I was able to bring my balcony back to life, with minimal effort!</p>
        <div class="author">Federica G.</div>
      </div>
      <div class="testimonial">
        <div class="stars">★★★★★</div>
        <p>I hesitated a bit to get the L kit model for fear it was too big, but I actually made the right choice. I can grow whatever I want and it also leaves me the space to germinate some seedlings while the others grow.</p>
        <div class="author">Lodovico C.</div>
      </div>
      <div class="testimonial">
        <div class="stars">★★★★★</div>
        <p>It's nice to see zero-meter vegetables growing on my balcony and seeing them taller every morning is a blast!</p>
        <div class="author">Katherine C.</div>
      </div>
      <div class="testimonial">
        <div class="stars">★★★★★</div>
        <p>Growing with Hexagro at school is the most inclusive educational tool we ever had. I cannot wait to see my students - especially the ones who never eat veggies at home - harvest the first plants and eat them!</p>
        <div class="author">Prof. John M.</div>
      </div>
    </div>
    <div class="dots">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
  </div>
</body>
</html>