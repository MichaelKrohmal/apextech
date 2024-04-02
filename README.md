<h1>Apextech test</h1>

<h2>STEPS FOR LOCAL SETUP (First setup)</h2>
<ol>  
  <li>cp .env.local .env</li>
  <li>docker compose up -d</li>
  <li>docker exec -it apextech-workspace-1 bash</li>
  <li>composer install</li>
  <li>npm install</li>
  <li>artisan storage:link</li>
  <li>artisan migrate:fresh --seed</li>  
</ol>
