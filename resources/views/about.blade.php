<x-app-layout>
@include('partials.navbar')
<main class="About">
    <section class="Story">
        <div class="container">
            <h1 class="section_heading">Why Shea254?</h1>
            <div class="mission_statements">
                <div class="statement">
                    <h1>Natural</h1>
                    <p>Ingredients are obtained from natural resources and maintain their original chemical shape and structure.</p>
                </div>

                <div class="statement">
                    <h1>Naturally Delivered</h1>
                    <p>Ingredients are harvested or picked and made to undergo some form of chemical reaction e.g. fermentation or distillation.</p>
                </div>

                <div class="statement">
                    <h1>Nature Identical</h1>
                    <p>Ingredients are synthetically processed but identical in their chemical structure to the ingredients found in nature.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="Location">
        <div class="container">
            <div class="details">
                <p>Nairobi CBD <br />Sasa Mall, Moi Avenue <br />Shop G20</p>
                <p>Business Hours: 08:00 A.M - 05:00 P.M</p>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!4v1712003822208!6m8!1m7!1snjt8vM8lwBBNAfQHF3ccfw!2m2!1d-1.282796377812188!2d36.82287824180283!3f28.984308039843892!4f-0.7431016627225233!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</main>
@include('partials.footer')
</x-app-layout>
