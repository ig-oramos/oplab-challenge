/**
 * Game of Stones function
 * @author Igor Gomes Oliveira Ramos <igor.gomesz55@gmail.com>
 */
static String gameOfStones(int n) {
    if (n == 1 || n % 7 == 0 || n % 7 == 1)
        return "Second";
    else return "First";
}